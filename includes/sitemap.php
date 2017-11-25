<?php

function openPage($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    return curl_exec($ch);
    curl_close($ch);    
}

if ($documentRoot == '/var/www/websites/redesign2013'){

    $websiteURL = 'http://redesign2013.linux.ycyrffgroupie.co.uk/';

}else{

    $websiteURL = 'http://lwww.ycyrffgroupie.co.uk/';

}

$html = openPage($websiteURL);
$pos = strpos($html, '<div id="menu">');
$textLength = strlen($html);
$length = $textLength - $pos;

$html = substr($html, strpos($html, '<div id="menu">'), $length);
$pos = strpos($html, '</div>');

$html = substr($html,0, $pos);

$pos = strpos($html, '<li>');
$textLength = strlen($html);
$length = $textLength - $pos;

$html = substr($html,strpos($html, '<li>'), $length);
$html = preg_replace('/<!--end being in another file. -->/','',$html);

$pos = strrpos($html, '</ul>');

$html = substr($html,0, $pos);
$html = rtrim($html);

$menuParts = preg_split("/\\r\\n|\\r|\\n/", $html);

$menu = array();

foreach ($menuParts as $menuPart){
    
    if (preg_match('%Home%', $menuPart) === 1){
    
        
	$menu["Home / Gartre"] = array();
	
	$pos = strpos($menuPart, '">');
	$pos = $pos + 2;
	$textLength = strlen($menuPart);
	$length = $textLength - $pos;
		    
	$name = substr($menuPart, $pos, $length);
	$name = strip_tags($name, '<span>');
	
	$link = substr($menuPart, 0, $pos);
	$link = strip_tags($link, '<a>');
	
	$pos = strpos($link, '/');
	$textLength = strlen($link);
	$length = $textLength - $pos;
		    
	$link =  substr($link, $pos, $length);
	$link =  substr($link, 0, -2);
	
	$menu["Home / Gartre"]["sectionName"] = "Home / Gartre";
	$menu["Home / Gartre"]["sectionItems"] [0]["name"] = $name;
	$menu["Home / Gartre"]["sectionItems"] [0]["link"] = $link;
    
    }else{
    
        if (strpos($menuPart, '<ul>') === false && 
	strpos($menuPart, '</ul>') === false
	/*preg_match('%<ul>|</ul>%', $menuPart) === 0*/){
	
	    if (strpos($menuPart, '<a href') === false){
	    
	        If (strpos($menuPart, '</li>') === false){
		    
		    $sectionHeading = strip_tags($menuPart);
		    $sectionHeading = trim($sectionHeading);
		    $menu[$sectionHeading]["sectionName"] = $sectionHeading;
		    $menu[$sectionHeading]["sectionItems"] = array();
		    $i = 0;
		
		}
		
	    
	    }else{
	    
	        if (strpos($menuPart, '<!--<li>') === false){
		
		    $pos = strpos($menuPart, '">');
		    $pos = $pos + 2;
		    $textLength = strlen($menuPart);
		    $length = $textLength - $pos;
		    
		    $name = substr($menuPart, $pos, $length);
		    $name = strip_tags($name, '<span>');
		    
		    if (strpos($menuPart, "-->") !== false){
		        
			$pos2 = strpos($name, "-->");
			$pos2 = $pos2 + 3;
			$textLength = strlen($name);
		        $length = $textLength - $pos2;
			
			$name = substr($name, $pos2, $length);
			
			$pos2 = strpos($menuPart, "-->");
			$pos2 = $pos2 + 3;
			
			$link = substr($menuPart, $pos2, $length);
			
			$pos2 = strpos($link, "rel");
			
			$link = substr($link, 0, $pos2);
		    
		    }else{
		    
		        $link = substr($menuPart, 0, $pos);
			$link = strip_tags($link, '<a>');
		    
		    }
		    
		    $pos = strpos($link, '/');
		    $textLength = strlen($link);
		    $length = $textLength - $pos;
		    
		    $link =  substr($link, $pos, $length);
		    $link =  substr($link, 0, -2);
		    
		    $menu[$sectionHeading]["sectionItems"] [$i]["name"] = $name;
		    $menu[$sectionHeading]["sectionItems"] [$i]["link"] = $link;
		    
		    $i ++;
		    
		}
	    
	    }
	
	
	}
    
    }

}

?>
	<div class="sitemapContainer" style="">
<?php

foreach ($menu as $section){
    
?>

		<div class="section">
			
		
		<?php
		if ($section["sectionName"] === "Home / Gartre"){
		?>
		
			<div class="sectionHeader">
				<a href="<?php echo $section["sectionItems"][0]["link"]?>"><?php echo $section["sectionName"];?></a>
			</div>
			
		
		<?php
		}else{
		?>
			<div class="sectionHeader"><?php echo $section["sectionName"];?></div>
		<?php
		    foreach ($section["sectionItems"] as $item){
		         
			 //print_r($item);
			 ?>
			 
			<div class="item">
				<a href="<?php echo $item['link']?>"><?php echo $item["name"];?></a>
			</div>
			 
			 <?php
		    
		    }
		
		}
		?>
	
		</div>
    
<?php

}

?>
	</div>