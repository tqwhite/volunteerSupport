<?php

include('petOfTheWeekParameters.php');

//===========================================

$story=htmlentities($story);
$story=str_replace("'", "&apos;", $story);

$storySquare='templates/storySquare.html';
$petSquare='templates/petSquare.html';

if ($story){
	$templateName=$storySquare;
}
else{
	$templateName=$petSquare;
}


$dateObj = new DateTime($dateString);
$date=$dateObj->format('F d, Y');
$shortDate=$dateObj->format('m/d/y');
$filenameDate=$dateObj->format('M_d');

$destFileNameRoot="{$sequenceNumber}_$filenameDate";


$sourceImageBaseName='tmp';
$sourceImageFileName="$sourceImageBaseName.jpg";
$destImageFileName=str_replace($sourceImageBaseName, $destFileNameRoot, $sourceImageFileName);

$galleryParameterString="
templateName='$templateName';
petName='$petName';
date='$date';
story='$story';
";

$frontPageParameterString="
name='$petName';
date='$shortDate';
";

$siteDir="../../main/";

$frontPagePageDir=$siteDir.'_default/';
$frontPageMacrosDir="{$frontPagePageDir}MACROS/";
$frontPageMacrosFilePath="{$frontPageMacrosDir}petOfTheWeek.ini";

$frontPageImagesDir="{$frontPagePageDir}images/";
$frontPageImagesFilePath="{$frontPageImagesDir}petOfTheWeek.jpg";

$petDir=$siteDir.'petOfTheWeek/';
$parameterDir="{$petDir}parameterFiles/";
$destParameterFileName="$destFileNameRoot.ini";
$destParameterFilePath="$parameterDir$destParameterFileName";


$sourceImageDir="{$petDir}images/";
$sourceImageFilePath="$sourceImageDir$sourceImageFileName";

$destImageDir="{$petDir}panelImages/";
$destImageFilePath="$destImageDir$destImageFileName";

if (!file_exists($sourceImageFilePath)){
	die("\n\nERROR: image file is missing: $sourceImageFilePath\n\n");
}

// if (file_exists($destParameterFilePath)){
// 	die("\n\nERROR: destination file already exists: $destParameterFilePath\n\n");
// }
// 
// if (file_exists($destImageFilePath)){
// 	die("\n\nERROR: destination file already exists: $sourceImageFilePath\n\n");
// }

echo "\n\n";
if ($dryRun){
$name='sourceImageFilePath'; echo $$name."=\n     ".realpath($$name)."\n\n";
$name='destImageFilePath'; echo $$name."=\n     ".realpath($$name)."\n\n";
$name='destParameterFilePath'; echo $$name."=\n     ".realpath($$name)."\n\n";
$name='frontPageMacrosFilePath'; echo $$name."=\n     ".realpath($$name)."\n\n";
$name='frontPageImagesFilePath'; echo $$name."=\n     ".realpath($$name)."\n\n";
}
else{
echo "destParameterFilePath status=".file_put_contents($destParameterFilePath, $galleryParameterString);
echo "\nsourceImageFilePath status=".copy($sourceImageFilePath, $destImageFilePath);
echo "\nfrontPageMacrosFilePath status=".file_put_contents($frontPageMacrosFilePath, $frontPageParameterString);
echo "\nsourceImageFilePath status=".copy($sourceImageFilePath, $frontPageImagesFilePath);
}
echo "\n\n";

