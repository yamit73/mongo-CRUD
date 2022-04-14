<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
   /**
    * Insert documents into users collection
    *
    * @return void
    */
    public function indexAction()
    {
        $collection = $this->mongo->users;
        if ($this->request->isPost()) {
            $insertOneResult = $collection->insertOne($this->request->getPost());
            $this->view->message=$insertOneResult->getInsertedId();
        }
    }

    /**
     * Read or find from Users collection
     *
     * @return void
     */
    public function readAction()
    {
        $collection = $this->mongo->users;
        $this->view->users=$collection->find();
    }

    /**
     * Update document into Users collection
     *
     * @return void
     */
    public function updateAction($id)
    {
        //Find user using _id
        $collection = $this->mongo->users;
        $this->view->users=$collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        if ($this->request->isPost()) {
            //Update user details
            $updateResult = $collection->updateOne(
                ['_id'=>new MongoDB\BSON\ObjectID($id)],
                ['$set'=>$this->request->getPost()]
            );
        $this->view->message=$updateResult->getMatchedCount();
        }
        
    }
    /**
     * delete document from Users collection
     *
     * @return void
     */
    public function deleteAction($id)
    {
        $collection = $this->mongo->users;
        $collection->deleteOne(['_id'=>new MongoDB\BSON\ObjectID($id)]);
        $this->response->redirect('index/read');
    }
    public function isAction()
    {
        $collection = $this->mongo->users;
        $insertOneResult = $collection->insertOne([
            'name'=>'ak3',
            'email'=>'ak3@gmail.com',
            'username'=>'ak3@gmail.com',
        ]);
        $this->view->message=$insertOneResult->getInsertedId();
    }
}
