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

        $insertOneResult = $collection->insertOne([
            'username' => 'ak',
            'email' => 'ak@gmail.com',
            'name' => 'User',
        ]);

        printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

        var_dump($insertOneResult->getInsertedId());die;
    }

    /**
     * Read or find from Users collection
     *
     * @return void
     */
    public function findAction()
    {
        $collection = $this->mongo->users;
        echo '<pre>';
        print_r($collection->findOne(['username' => 'amit']));die;
    }

    /**
     * Update document into Users collection
     *
     * @return void
     */
    public function updateAction()
    {
        $collection = $this->mongo->users;
        $updateResult = $collection->updateOne(
            ['username'=>'admin'],
            ['$set'=>['email'=>'admin@gmail.com']]
        );
        printf("Matched %d document(s)\n", $updateResult->getMatchedCount());die;
    }
    /**
     * delete document from Users collection
     *
     * @return void
     */
    public function deleteAction()
    {
        $collection = $this->mongo->users;
        $deleteResult = $collection->deleteOne(['username' => 'ak']);
        printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());
    }
}
