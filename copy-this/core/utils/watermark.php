<?php
// Checks if instance name getter does not exist
if ( !function_exists( "getGeneratorInstanceName" ) ) {
/**
* Returns image generator instance name
*
* @return string
*/
function getGeneratorInstanceName()
{
   return "watermark";
}
}
require_once "../oxdynimggenerator.php";
class watermark extends oxDynImgGenerator
{   
   protected function _generateJpg( $sSource, $sTarget, $iWidth, $iHeight, $iQuality )
    {
	if ( substr_count($sTarget, "665_665_75") > 0 || substr_count($sTarget, "380_340_75") > 0)

	{
	       $strImageDestination = $sSource;

		//wasserzeichen aus out/pictures/watermark/ laden

		$wz=str_replace("master","@",$sSource);
		$at_pos = strpos($wz, "@");
		$tld_length = strlen($wz);
		$wz1= substr($wz, ($at_pos), $tld_length);
	  	$strImageWatermark = str_replace($wz1,"watermark/wz.png",$wz);

	       $iQuality = 100;
	       list ( $iDestinationWidth, $iDestinationHeight,
	       $iDestinationType ) = getimagesize ( $strImageDestination );
	       list ( $iWatermarkWidth, $iWatermarkHeight,
	       $iWatermarkType ) = getimagesize ( $strImageWatermark );
	 
	       $rDestination = imagecreatefromjpeg ( $strImageDestination );
	       $rWatermark = imagecreatefrompng ( $strImageWatermark );

	       $iPositionX = ceil ( ( $iDestinationWidth / 2 ) );
	       $iPositionX -= ceil ( ( $iWatermarkWidth / 2 ) );
	       $iPositionY = ceil ( ( $iDestinationHeight / 2 ) );
	       $iPositionY -= ceil ( ( $iWatermarkHeight / 2 ) );

	     	imagecopy ( $rDestination, $rWatermark, $iPositionX,
	                   $iPositionY, 0, 0, $iWatermarkWidth,
	                   $iWatermarkHeight);
	
	      	header ( 'content-type: image/jpeg' );
		$watermark=str_replace("/master/","/watermark/",$sSource);
	      	if ($this->_isTargetPathValid($watermark))
	      	{
	      		imagejpeg ( $rDestination, $watermark , $iQuality );
	      	}
	
	  	imagedestroy ($rDestination);
	  	imagedestroy ( $rWatermark );	
	     	
		return resizeJpeg( $watermark , $sTarget, $iWidth, $iHeight, @getimagesize( $sSource ), getGdVersion(), null, $iQuality );
	}
	else
	{	
		return resizeJpeg( $sSource , $sTarget, $iWidth, $iHeight, @getimagesize( $sSource ), getGdVersion(), null, $iQuality );
	}
    }
    protected function _generatePng( $sSource, $sTarget, $iWidth, $iHeight )
    {
	if ( substr_count($sTarget, "665_665_75") > 0 || substr_count($sTarget, "380_340_75") > 0)

	{
	       $strImageDestination = $sSource;

		//wasserzeichen aus out/pictures/watermark/ laden

		$wz=str_replace("master","@",$sSource);
		$at_pos = strpos($wz, "@");
		$tld_length = strlen($wz);
		$wz1= substr($wz, ($at_pos), $tld_length);
	  	$strImageWatermark = str_replace($wz1,"watermark/wz.png",$wz);

	       list ( $iDestinationWidth, $iDestinationHeight,
	       $iDestinationType ) = getimagesize ( $strImageDestination );
	       list ( $iWatermarkWidth, $iWatermarkHeight,
	       $iWatermarkType ) = getimagesize ( $strImageWatermark );
	 
	       $rDestination = imagecreatefrompng ( $strImageDestination );
	       $rWatermark = imagecreatefrompng ( $strImageWatermark );

	       $iPositionX = ceil ( ( $iDestinationWidth / 2 ) );
	       $iPositionX -= ceil ( ( $iWatermarkWidth / 2 ) );
	       $iPositionY = ceil ( ( $iDestinationHeight / 2 ) );
	       $iPositionY -= ceil ( ( $iWatermarkHeight / 2 ) );

	     	imagecopy ( $rDestination, $rWatermark, $iPositionX,
	                   $iPositionY, 0, 0, $iWatermarkWidth,
	                   $iWatermarkHeight);
	
	      	header ( 'content-type: image/png' );
		$watermark=str_replace("/master/","/watermark/",$sSource);
	      	if ($this->_isTargetPathValid($watermark))
	      	{
	      		imagepng ( $rDestination, $watermark );
	      	}
	
	  	imagedestroy ($rDestination);
	  	imagedestroy ( $rWatermark );	
	     	
		return resizePng( $watermark, $sTarget, $iWidth, $iHeight, @getimagesize( $sSource ), getGdVersion(), null );	}
	else
	{	
		return resizePng( $sSource, $sTarget, $iWidth, $iHeight, @getimagesize( $sSource ), getGdVersion(), null );	}
    }
}
require_once "getimg.php";

?>
