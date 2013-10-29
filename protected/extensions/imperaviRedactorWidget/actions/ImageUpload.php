<?php

/**
 * Redactor widget image upload action.
 *
 * @param string $attr Model attribute
 * @throws CHttpException
 */

class ImageUpload extends CAction
{
	public $uploadPath;
	public $uploadUrl;
	public $uploadCreate=false;
	public $permissions=0777;

	public function run($attr)
	{
		$name=strtolower($this->getController()->getId());
		$attribute=strtolower((string)$attr);

		if ($this->uploadPath===null) {
			$path=Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'uploads';
			$this->uploadPath=realpath($path);
			if ($this->uploadPath===false && $this->uploadCreate===true) {
				if (!mkdir($path,$this->permissions,true)) {
					throw new CHttpException(500,CJSON::encode(
						array('error'=>'Could not create upload folder "'.$path.'".')
					));
				}
			}
		}
		if ($this->uploadUrl===null) {
			$this->uploadUrl=Yii::app()->request->baseUrl .'/uploads';
		}

		// Make Yii think this is a AJAX request.
		$_SERVER['HTTP_X_REQUESTED_WITH']='XMLHttpRequest';

		$file=CUploadedFile::getInstanceByName('file');
		if ($file instanceof CUploadedFile) {
			$attributePath=$this->uploadPath.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.$attribute;
			if (!in_array(strtolower($file->getExtensionName()),array('gif','png','jpg','jpeg'))) {
				throw new CHttpException(500,CJSON::encode(
					array('error'=>'Invalid file extension '. $file->getExtensionName().'.')
				));
			}
			$fileName=trim(md5($attribute.time().uniqid(rand(),true))).'.'.$file->getExtensionName();
			if (!is_dir($attributePath)) {
				if (!mkdir($attributePath,$this->permissions,true)) {
					throw new CHttpException(500,CJSON::encode(
						array('error'=>'Could not create folder "'.$attributePath.'". Make sure "uploads" folder is writable.')
					));
				}
			}

//

			// $thumb=CUploadedFile::getInstanceByName('file');//
			// $attributePathThumb=$this->uploadPath.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.$attribute.DIRECTORY_SEPARATOR.'thumb';
			// $thumb->thumb('200', '200');
			// $thumbName=$fileName;
			// if (!is_dir($attributePathThumb)) {
			// 	if (!mkdir($attributePathThumb,$this->permissions,true)) {
			// 		throw new CHttpException(500,CJSON::encode(
			// 			array('error'=>'Could not create folder "'.$attributePathThumb.'". Make sure "uploads" folder is writable.')
			// 		));
			// 	}
			// }
//
			$path=$attributePath.DIRECTORY_SEPARATOR.$fileName;
			if (file_exists($path) || !$file->saveAs($path)) {
				throw new CHttpException(500,CJSON::encode(
					array('error'=>'Could not save file or file exists: "'.$path.'".')
				));
			}
			
			// $pathThumb=$attributePathThumb.DIRECTORY_SEPARATOR.$thumbName;//
			// 	if (file_exists($pathThumb) || !$thumb->saveAs($pathThumb)) {
			// 	throw new CHttpException(500,CJSON::encode(
			// 		array('error'=>'Could not save file or file exists: "'.$pathThumb.'".')
			// 	));
			// }
			//

			$attributeUrl=$this->uploadUrl.'/'.$name.'/'.$attribute.'/'.$fileName;
			//$attributeUrlThumb=$this->uploadUrl.'/'.$name.'/'.$attribute.'/'.'thumb/'.$thumbName;
			$data = array(
				'filelink' => $attributeUrl,
				//'link' => $attributeUrl,
			);
			echo CJSON::encode($data);
			exit;
		} else {
			throw new CHttpException(500,CJSON::encode(
				array('error'=>'Could not upload file.')
			));
		}
	}
}