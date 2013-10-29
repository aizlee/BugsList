<?php
class UploadController extends Controller
{
  public function actionImageUpload()
        {
            var_dump($_FILES);
            $this->layout=false;
             if(isset($_FILES) && isset($_FILES['file']['tmp_name']))
            {
                $name=$_FILES['file']['name'];// Тут - ваша функция преобразования имени файла в нужное 
                $ih=new CImageHandler(); 
                /*Загружаем изображение и делаем для него thumbnail  любым удобным способом*/
                $ih->load($_FILES['file']['tmp_name'])
                    ->thumb(200,200)
                    ->save(Yii::getPathOfAlias('application.upload.images').'/thumbs/'.$name)
                    ->reload()
                    ->save(Yii::getPathOfAlias('application.upload.images').'/'.$name);

                $array = array(
                            'filelink' => Yii::getPathOfAlias('application.upload.images').'/thumbs/'.$name,//URL на превью картинки,
                            'link' => Yii::getPathOfAlias('application.upload.images').$name,//URL на полную картинку,
                        );
                                 echo stripslashes(json_encode($array));
                Yii::app()->end();

            }
            echo 'no files';
            Yii::app()->end();
        }

        public function actionFileupload()
        {
            $this->layout=false;
            if(isset($_FILES) && isset($_FILES['file']['tmp_name']))
            {               
                $name=$_FILES['file']['name'];
                /*Проверки, и прочая бодяга*/
                move_uploaded_file($_FILES['file']['tmp_name'],Yii::getPathOfAlias('webroot.upload.files').'/'.$name);
                $array = array(
                   'fileclass'=>'uplfile', /*Здесь можно указать класс для файла, в т.ч зависящий от расширения*/
                    'filelink' => '',//URL на файл,
                    'filename'=>$name
                );
                 echo stripslashes(json_encode($array));
                Yii::app()->end();

            }

            echo 'no files';
            Yii::app()->end();
        }

        public function actionListimages(){
            $images = array();
            $array=array();
            $images= scandir('/path/to/uploaded/images/');
            foreach($images as $image)
                $array[]=array(
                    'thumb'=>'',//URL на превью,
                    'image'=>'',//URL на полное изображение,
                );

            header('Content-type: application/json');
            echo CJSON::encode($array);

        }
         public function actionListfiles(){
            $res = array();
/*Если в папке для загрузки несколько подпапок (например по дате, по типу контента и т.п.) - с помощью данной функции 
можно подготовить массив файлов с учётом папок, и в форме выбора файлв имперави позволит переключать папки
(Аналогично можно и для изображений использовать)
 */
            $res=$this->treedir(Yii::getPathOfAlias('webroot.uploads.files'));
            $array=array();
            foreach($res as $k=>$folder)
            {
                foreach($folder as $f)
                {
                $fileclass='uplfile file_'.Help::getExt($f); /*Таким образом можно присвоить классы в зависимости от расширения файла, чтобы в последствие с помощью css приделать картинки */
                $array[]=array( 
                    'folder'=>$k,
                    'filename'=>$f,
                    'fileclass'=>$fileclass,
                    'filelink'=>'',//URL ссылки на файл
                );
                }

            }
            header('Content-type: application/json');
            echo CJSON::encode($array);

        }

        private function treedir($folder,$tree=array(),$level=0){   
        $files = scandir($folder);
        $fname=explode('/',$folder);
        $i=count($fname)-1;
        $fname=  str_repeat('-', $level).$fname[$i];
        foreach($files as $file)
        {
                if($file!=='.' && $file!=='..')
                {
                        if(is_dir($folder."/".$file)) 
                        {

                                $tree=$this->treedir($folder."/".$file,$tree,$level+1); 
                        }
                        else
                        {
                            $tree[$fname][]=$file;
                        }
                }       
        }
        return $tree;
     }public function actionImageUpload()
        {
            $this->layout=false;
             if(isset($_FILES) && isset($_FILES['file']['tmp_name']))
            {
                $name=$_FILES['file']['name'];// Тут - ваша функция преобразования имени файла в нужное 
                $ih=new CImageHandler(); 
                /*Загружаем изображение и делаем для него thumbnail  любым удобным способом*/
                $ih->load($_FILES['file']['tmp_name'])
                    ->thumb(200,200)
                    ->save(Yii::getPathOfAlias('application.upload.images').'/thumbs/'.$name)
                    ->reload()
                    ->save(Yii::getPathOfAlias('application.upload.images').'/'.$name);

                $array = array(
                            'filelink' => Yii::getPathOfAlias('application.upload.images').'/thumbs/'.$name,//URL на превью картинки,
                            'link' => Yii::getPathOfAlias('application.upload.images').$name,//URL на полную картинку,
                        );
                                 echo stripslashes(json_encode($array));
                Yii::app()->end();

            }
            echo 'no files';
            Yii::app()->end();
        }

        public function actionFileupload()
        {
            $this->layout=false;
            if(isset($_FILES) && isset($_FILES['file']['tmp_name']))
            {               
                $name=$_FILES['file']['name'];
                /*Проверки, и прочая бодяга*/
                move_uploaded_file($_FILES['file']['tmp_name'],Yii::getPathOfAlias('webroot.upload.files').'/'.$name);
                $array = array(
                   'fileclass'=>'uplfile', /*Здесь можно указать класс для файла, в т.ч зависящий от расширения*/
                    'filelink' => '',//URL на файл,
                    'filename'=>$name
                );
                 echo stripslashes(json_encode($array));
                Yii::app()->end();

            }

            echo 'no files';
            Yii::app()->end();
        }

        public function actionListimages(){
            $images = array();
            $array=array();
            $images= scandir('/path/to/uploaded/images/');
            foreach($images as $image)
                $array[]=array(
                    'thumb'=>'',//URL на превью,
                    'image'=>'',//URL на полное изображение,
                );

            header('Content-type: application/json');
            echo CJSON::encode($array);

        }
         public function actionListfiles(){
            $res = array();
/*Если в папке для загрузки несколько подпапок (например по дате, по типу контента и т.п.) - с помощью данной функции 
можно подготовить массив файлов с учётом папок, и в форме выбора файлв имперави позволит переключать папки
(Аналогично можно и для изображений использовать)
 */
            $res=$this->treedir(Yii::getPathOfAlias('webroot.uploads.files'));
            $array=array();
            foreach($res as $k=>$folder)
            {
                foreach($folder as $f)
                {
                $fileclass='uplfile file_'.Help::getExt($f); /*Таким образом можно присвоить классы в зависимости от расширения файла, чтобы в последствие с помощью css приделать картинки */
                $array[]=array( 
                    'folder'=>$k,
                    'filename'=>$f,
                    'fileclass'=>$fileclass,
                    'filelink'=>'',//URL ссылки на файл
                );
                }

            }
            header('Content-type: application/json');
            echo CJSON::encode($array);

        }

        private function treedir($folder,$tree=array(),$level=0){   
        $files = scandir($folder);
        $fname=explode('/',$folder);
        $i=count($fname)-1;
        $fname=  str_repeat('-', $level).$fname[$i];
        foreach($files as $file)
        {
                if($file!=='.' && $file!=='..')
                {
                        if(is_dir($folder."/".$file)) 
                        {

                                $tree=$this->treedir($folder."/".$file,$tree,$level+1); 
                        }
                        else
                        {
                            $tree[$fname][]=$file;
                        }
                }       
        }
        return $tree;
     }
}?>