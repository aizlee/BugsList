<?php
class StockController extends CController
{
    public function actions()
    {
        return array(
            'quote'=>array(
                'class'=>'CWebServiceAction'
            ),
        );
    }

    /**
     * @param integer
     * @return object[]
     * @soap 
     */
   public function loadModel($id)
    {
        $condition = 'status < 4  and id_client =' . $id;
        $ord = 'status asc ,receive_date asc';

        $query = Yii::app()->db->createCommand()
            ->select('*')
            ->from('bugs')
            ->where($condition)
            ->order($ord)
            ->queryAll();
        foreach ($query as &$element ){
             $element['id_client'] = Tickets::getFullFio($element['id_client']);
             $element['id_employee'] = Tickets::getUserFullFio($element['id_employee']); 
        }
         return $query;
    }


     /**
     * @param integer
     * @return array
     * @soap 
     */
   public function loadTicket($id)
    {
        $condition = 'status < 4 and id =' . $id;
        $query = Yii::app()->db->createCommand()
            ->select('*')
            ->from('bugs')
            ->where($condition)
            ->queryAll();
         return $query;
    }


     /**
     * @param integer
     * @return object
     * @soap 
     */
   public function loadComment($id)
    {   
        $condition = 'owner_id =' . $id;
        $query = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tbl_comments')
            ->where($condition)
            ->queryAll();
        foreach ($query as &$element ){
                $cond = 'id =' . $element['owner_id'];
                $user= Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('tbl_users')
                    ->where($cond)
                    ->queryRow();
                $element["user_name"] = $user['username'] ;   
                $element["user_email"] = $user['email'] ; 
            }    
         return $query;
    }

    
    /**
     * @param array
     * @return boolean
     * @soap 
     */
   public function addClient($userData)
    {
      
        $model=new Clients;
        if(isset($userData))
        {
            $model->id =$userData['id'];
            $model->email= $userData['email'];
            $model->last_name= $userData['last_name'];
            $model->first_name= $userData['first_name'];
            if($model->save()){
                return TRUE;
            }
        }
          return FALSE;
    }



    /**
     * @param array
     * @return boolean
     * @soap 
     */
 public function addComment($commentData)
    {
      
        // $model=new Comment;
        // if(isset($commentData))
        // {
        //     $model->owner_name =$commentData['owner_name'];
        //     $model->owner_id = $commentData['owner_id'];
        //     $model->user_name = $commentData['user_name'];
        //     $model->user_email = $commentData['user_email'];
        //     $model->create_time = $commentData['create_time'];
        //     $model->comment_text = $commentData['comment_text'];
        //     if($model->save()){
        //         return TRUE;
        //     }
        // }
        //   return FALSE;
        $query = Yii::app()->db->createCommand();
        $query->insert('tbl_comments', $commentData);
        return TRUE;
    }

     /**
     * @param array
     * @return boolean
     * @soap 
     */
   public function addBug($bug)
    {
      
        $model=new Tickets;
        if(isset($bug))
        {
            $model->attributes=$bug;
           
            if($model->save()){
                return TRUE;
            }
        }
          return FALSE;
    }
}
?>