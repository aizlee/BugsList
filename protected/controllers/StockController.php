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
        foreach ($query as &$element ){
             $element['id_client'] = Tickets::getFullFio($element['id_client']);
             $element['id_employee'] = Tickets::getUserFullFio($element['id_employee']); 
        }
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

public function sendEmail($commentData){
        $emailsToSend = array();
        $queryCommentsMail = Yii::app()->db->createCommand()
            ->select('user_email, creator_id')
            ->from('tbl_comments')
            ->where('owner_id = ' . $commentData['owner_id'])
            ->queryAll();

        foreach ($queryCommentsMail as $mail) {
            
            if($mail['user_email'] == NULL){
                
                $queryEmployeeEmail = Yii::app()->db->createCommand()
                    ->select('email')
                    ->from('tbl_users')
                    ->where('id = ' . $mail['creator_id'])
                    ->queryRow();

                if(!in_array($mail['user_email'], $emailsToSend)){
                    $emailsToSend[] = $queryEmployeeEmail['email'];
                } 
                  
            }
            
            else{
                
                if(!in_array($mail['user_email'], $emailsToSend)){
                    $emailsToSend[] = $mail['user_email'];
                }

            }

        }
                
        $queryCreatorMail = Yii::app()->db->createCommand()
            ->select('id_creator, id_client')
            ->from('bugs')
            ->where('id = ' . $commentData['owner_id'])
            ->queryRow();
        
        if (!empty($queryCreatorMail['id_creator'])) {
            $creatorEmail = Tickets::getCreatorEmail($queryCreatorMail['id_creator']);
            if (!in_array($creatorEmail, $emailsToSend)) {
                $emailsToSend[] = $creatorEmail;
            }
        }
        else {
            $creatorEmail = Tickets::getEmail($queryCreatorMail['id_client']);
            if (!in_array($creatorEmail, $emailsToSend)) {
                $emailsToSend[] = $creatorEmail;
            }
        }

        foreach ($emailsToSend as $email) {
            $message = 'К тикету № ' . $commentData['owner_id'] . ' добавлен новый комментарий.';
            mail($email,'Новый комментарий ', $message);
        }
}

    /**
     * @param array
     * @return boolean
     * @soap 
     */
 public function addComment($commentData)
    {
        $query = Yii::app()->db->createCommand();
        $query->insert('tbl_comments', $commentData);
        $this->sendEmail($commentData);
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