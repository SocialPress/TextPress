<?php
/**
* SoLocal - a micro marketing framework
*
* @author J.R. Hull <companygateways@gmail.com>
* @version 1.0
* @copyright J.R. Hull - The Austin Conner Group
*
* 
*/

/**
* Require necessary files
*/
require '../Slim/Slim.php';


/**
* Create an instance of Slim
*/
$app = new Slim();
$app->add(new Slim_Middleware_ContentTypes());

/**
* Post update to page
*
* POST:/api/post/update
* 
*/
$app->post('/post/update(/:site)', function($site='') use ($app) {

    $response = array(
	    'status'=>'ok',
	    'message'=> array(),
	    'data'=> array()
	);

    try{
	$config = getConfig($site);
	$response['message'][] = 'Data Recived';
    }
    catch(Exception $e){
	$response['status'] = 'Error';
	$response['message'][] = 'Error Code: '.$e->getCode();
	goto exit_on_error;
    }
    // get the data
    $data = $app->request()->getBody();
    // create the object
    $post = json_decode($data);    
    
    //loop thru each post update
    foreach($post->data as $update){
	
	try{
	    // normalize date
	    $update->date = substr($update->date,0,10);
	    // Build Path
	    $postFileName = $update->date.'-'.$update->slug;
	    $postPath = $_SERVER['DOCUMENT_ROOT'].$config['article.path'].'/'.$postFileName.'.json';
	    //$response['message'][] = 'Updating Post '.$postPath	;
	    // Convert to json string
	    $fc =  json_encode($update);
	    //write post update
	    $handle = fopen($postPath, 'x');
	    fwrite($handle, $fc);
	    $response['message'][] = 'Post Saved: '.$postFileName;
	    fclose($handle);
	}
	catch(Exception $e){
	    $response['status'] = 'Error';
	    $response['message'][] = 'Error Code: '.$e->getCode();
	}
    }
    
exit_on_error:    
    // send a response!
    $app->contentType('application/json');
    echo json_encode($response);
    
});

/**
* Post image to gallery
*
* POST:/api/post/media
* 
*/
$app->post('/post/media(/:site)', function($site='') use ($app) {

    $response = array(
	    'status'=>'ok',
	    'message'=> array(),
	    'data'=> array()
	   );
    try{
	$config = getConfig($site);
	$response['message'][] = 'Data Recived';
    }
    catch(Exception $e){
	$response['status'] = 'Error';
	$response['message'][0] = 'Error Code: '.$e->getCode();
	goto exit_on_error;
    }
    // get the file data
    $fileName = $_FILES['imageFile']['name'];
    $fileSize = $_FILES['imageFile']['size'];
    $extension = getExtension($fileName);
    // check extension
    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
	$response['status'] = 'Error';
	$response['message'][0] = 'Error Code: Unknown Image extension';
	goto exit_on_error;
    }
    // get meta
    $galleryDate = $_POST['date'];
    $imgTitle = $_POST['title'];
    $imgDescription = $_POST['description'];
    
    //$response['message'][] = 'Data Recived';

    if(is_uploaded_file($_FILES['imageFile']['tmp_name'])) {
	
	$fileName = md5($_SERVER['REQUEST_TIME']);
	$galleryPath = $_SERVER['DOCUMENT_ROOT'].$config['media.path'].'/'.date("Y/m/");
	// check if path exists
	if(!is_dir($galleryPath)) mkdir($galleryPath, 0777, true);
	
	// normilze image
	$uploadedfile = $_FILES['imageFile']['tmp_name'];
	if($extension=="jpg" || $extension=="jpeg" ){
	    $src = imagecreatefromjpeg($uploadedfile);
	}
	else if($extension=="png"){
	    $src = imagecreatefrompng($uploadedfile);
	}
	else {
	    $src = imagecreatefromgif($uploadedfile);
	}    
	list($width,$height)=getimagesize($uploadedfile);
	
	$newwidth=600; // resize for gallery
	$newheight=($height/$width)*$newwidth;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	//save the image
	$imgFileName =  md5($_SERVER['REQUEST_TIME']).'.jpg';
	imagejpeg($tmp,$galleryPath.'/'.$imgFileName,100);
	//imagedestroy($tmp);

	$newwidth=200; // resize for social thumbs
	$newheight=($height/$width)*$newwidth;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	//save the thumb
	$thumbFileName =  md5($_SERVER['REQUEST_TIME']).'.thumb.jpg';
	imagejpeg($tmp,$galleryPath.'/'.$thumbFileName,100);
	imagedestroy($tmp);
	
	imagedestroy($src);

	// assemble file name /path to media/2012-09-media.json
	$mediaPath = $_SERVER['DOCUMENT_ROOT'].$config['media.path'].'/'.$galleryDate.'-media.json';
	if (!file_exists($mediaPath)) {
	    // create a new media file
	    $handle = fopen($mediaPath, 'x');
	    $mediaData = array(
		'domain' => 'http://img.socialpress.com/',
		'date' => $galleryDate,
		'images' => array()
	    );
	    //
	    fwrite($handle, json_encode($mediaData));
	    
	}
	else{
	    // open media file
	    $handle = fopen($mediaPath, 'r+');
	    $content = stream_get_contents($handle);
	    $mediaData = (array)json_decode($content);
	    
	}
	
	if($site !== '') $site = '/'.$site; 
	$mediaData['images'][] = array(
	    'date' => date("Y-m-d"),
	    'title'=>$imgTitle,
	    'description'=>$imgDescription,
	    'thumb'=> $site.'/'.date("Y-m-d").'/'.$thumbFileName,
	    'uri' => $site.'/'.date("Y-m-d").'/'.$imgFileName
	    );
	
	
	rewind($handle);
	fwrite($handle,json_encode($mediaData));
	

	$response['data'][] = array('mediaLink'=>'http://img.socialpress.com'.$site.'/'.date("Y-m-d").'/'.$thumbFileName);
	fclose($handle);
    }
    else{
	$response['status'] = 'Error';
	$response['message'][0] = 'Error Code: No File Specified';
	goto exit_on_error;
    }
    
exit_on_error:    
    // send a response!
    $app->contentType('application/json');
    echo json_encode($response);
    
});


/**
* Create blog
*
* POST:/api/site/setup
* 
*/
$app->post('/site/setup', function() use ($app) {

    $response = array(
	'status'=>'ok',
	'message'=> array()
       );
    $response['message'][] = 'Data Recived';
    // get the data
    $data = $app->request()->getBody();
    // get the object
    $site = json_decode($data);    
    
    // Setup Directories
    $configPath = $_SERVER['DOCUMENT_ROOT'].'/config';
    try{
	if(!mkdir($configPath.$site->siteSlug.'/articles', 0, true)){
	    $response['status'] = 'Error';
	    $response['message'][] = $configPath.$site->siteSlug.'/articles';
	    goto exit_on_error;
	}	    
	if(!mkdir($configPath.$site->siteSlug.'/media', 0, true)){
	    $response['status'] = 'Error';
	    $response['message'][] = $configPath.$site->siteSlug.'/media';
	    goto exit_on_error;
	}
    }
    catch(Exception $e){
	$response['status'] = 'Error';
	$response['message'][0] = 'Error Code: '.$e->getCode();
    }
    
    // Create Config array  
    $configArray = array(
        // Settings
	'base.directory'  => '',
	'prefix' => $site->siteSlug,   // prefix to be added with all URLs. eg : '/blog'
	'date.format' => 'd M, Y',   // Date format to be used in article page (not for routes)
	'layout.file' => 'layout',    // Site layout file
	'file.extension' => '.json',   // file extension of articles
	'disqus.username' => '',   // Your disqus username or false (Global)
	'markdown' => true, //Enable of disable markdown parsing.
	'media.path'=> './config'.$site->siteSlug.'/media',      // Path to images
	'article.path'=> './config'.$site->siteSlug.'/articles',      // Path to articles
	'templates.path' => './templates',  // Path to common templates
	'google.analytics' => false, // Google analytics code. set false to disable
	'google.map' => false, // Google analytics code. set false to disable
        // Globals - Site
        'header.background' => '',        
	'author.name' => '', // Global author name
	'site.name'  => $site->businessName,   // Site name "Brand"(Global)
	'site.title' => $site->siteTitle,  // Site default title (Global)
	'site.description' => $site->siteDescription,  // Site default description (Global)
	'site.image' => '',
        'location.phonenumber'  => $site->phoneNumber,   // Phone (Global)
	'location.address'  => $site->address,   // Street Address (Global)
	'location.locality'  => $site->locality,   // Street Address (Global)
	'location.region'  => $site->region,   // Location (Global)
	'location.postalcode'  => $site->postalCode,   // Location (Global)
	'location.country'  => $site->country,   // Location (Global)
        // Globals - Social
        'channels' => array(
        )
    );
    
    // Write Config
    try{
	// prep 
	$fc =  '<?php return '.var_export($configArray, true).';';
	//write post update
	$handle = fopen($configPath.$site->siteSlug.'/config.php', 'x');
	fwrite($handle, $fc);
	$response['message'][] = 'Config Saved: '.$configPath.$site->siteSlug;
	fclose($handle);
    }
    catch(Exception $e){
	$response['status'] = 'Error';
	$response['message'][0] = 'Error Code: '.$e->getCode();
    }

    
    
exit_on_error:    
    // send a response!
    $app->contentType('application/json');
    echo json_encode($response);
    
});



/**
* Returns a list of gallerey images 
*
* GET:/api/gallery[/site]/YYYY-MO/apikey
*
* /api/gallery/demo-one/2012-08/89uhhi878 
*
*/
$app->get('/gallery(/:site)/:year-:month', function($site ='', $year, $month) use ($app) {

    $response = array(
	    'status'=>'ok',
	    'message'=> array(),
	    'data'=> array()
	   );

    try{
	$config = getConfig($site);
	$response['message'][] = 'Data Recived';
    }
    catch(Exception $e){
	$response['status'] = 'Error';
	$response['message'][0] = 'Error Code: '.$e->getCode();
	goto exit_on_error;
    }
    
    $galleryMeta = '../'.$config['media.path'].'/'.$year.'-'.$month.'-media.json';
    $handle = fopen($galleryMeta, 'r');
    $response['data'][] = trim(stream_get_contents($handle));

exit_on_error:    
    // send a response!
    $app->contentType('application/json');
    echo json_encode($response);
    
});

/**
* Returns a list of galleries
*
* GET:/api/galleries[/site]/apikey
*
* /api/galleries/demo-one/89uhhi878
*/
$app->get('/galleries(/:site)', function($site ='') use ($app) {

    $response = array(
	    'status'=>'ok',
	    'message'=> array(),
	    'data'=> array()
	   );

    try{
	$config = getConfig($site);
	$response['message'][] = 'Data Recived';
    }
    catch(Exception $e){
	$response['status'] = 'Error';
	$response['message'][0] = 'Error Code: '.$e->getCode();
	goto exit_on_error;
    }
    
    $response['data'] = getfileNames('../'.$config['media.path'],$config['file.extension']);
    
    
exit_on_error:    
    // send a response!
    $app->contentType('application/json');
    echo json_encode($response);
    
});

//------------------------------------- Common Functions -------------------------//
/**
* Get config file
* @return Array config values
*
*/
function getConfig($siteName){
//echo $siteName;
	$segment = $siteName;
	// check for 'sub-blog'
	if (!file_exists('../config/'.$segment.'/config.php' ))
		$config = require '../config/config.php';
	else
		$config = @require '../config/'.$segment.'/config.php';

	return $config;

}

/**
* @return array file names from filePath
*/
function getfileNames($filePath, $extension)
{
    
    $fileNames =  array();
    $iterator = new DirectoryIterator($filePath);
    $files = new RegexIterator($iterator,'/\\'.$extension.'$/');
    foreach($files as $file){
	    if($file->isFile()){
		    $fileNames[] = $file->getFilename();
	    }
    }
    if(!empty($fileNames)){
	    rsort($fileNames);
    }
    return $fileNames;
}




/**
* @return file extension
*/
function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

/**
* run
*/
$app->run();


?>