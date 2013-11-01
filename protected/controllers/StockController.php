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
     * @return array 
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