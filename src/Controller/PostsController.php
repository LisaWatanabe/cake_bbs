<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;

class PostsController extends AppController
{
    public $paginate = [
        'limit' => 5,
        'order' => [
            'id' => 'DESC']
    ];
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    public function index() {
        $data = $this->paginate($this->Posts);
        $this->set('data', $data);
        $this->set('count', $data->count());
        // $query = $this->Posts->find()
        // ->where(['resId =' => 0])
        // ->order(['modified' => 'desc']);
        // $show_num = 20;
        // $posts = [];
    //     if (!empty($_GET['show_num'])) {
    //         $show_num = $_GET['show_num'];
    //         $this->paginate['limit'] = $show_num;
    //     $posts = $this->paginate($query);
    // }
        // $find = 'Not searching';
        // $posts_cnt = 0;
        // $posts = [];
        // if ($this->request->is('post')) {
        //     $find = $this->request->data['word'];
        //     $posts = $this->Posts->find()
        //         ->where(['title like' => '%'.$find.'%'])
        //         ->orWhere(['name like' => '%'.$find.'%'])
        //         ->orWhere(['content like' => '%'.$find.'%']);

        //     $posts_cnt = $this->Posts->find()
        //         ->where(['title like' => '%'.$find.'%'])
        //         ->orWhere(['name like' => '%'.$find.'%'])
        //         ->orWhere(['content like' => '%'.$find.'%'])
        //         ->count();
        //     }
        // $this->set(compact('posts','find','posts_cnt'));
        }



    public function view($postId = null)
    {
        $new_post = $this->Posts->newEntity();
        $posts = $this->Posts->find()
        ->where(['postId =' => $postId])
        ->order(['resId' => 'asc']);

        $this->set(compact('posts', 'new_post'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($post->postId == -1) {
                $post->postId = $this->Posts->find()
                ->order(['postId' => 'desc'])
                ->select(['postId'])
                ->first()['postId'] +1;
                $post->resId = 0;
            }

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $this->set(compact('post'));
        $this->set('_serialize', ['psot']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $this->set(compact('post'));
        $this->set('_serialize', ['psot']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $del_post = $this->Posts->get($id);
        if ($del_post->resId === 0) {
            if ($this->Posts->deleteAll(array('postId' => $del_post->postId))) {
                $this->Flash->success(__('The post has been deleted.'));
            } else {
                $this->Flash->error(__('The post could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        } elseif ($this->Posts->delete($del_post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }
}
    // public function find() {
        // $posts = [];
        // $find = 'Not searching';
        // $posts_cnt = 0;
        // if ($this->request->is('post')) {
        //     $find = $this->request->data['word'];
        //     $posts = $this->Posts->find()
        //         ->where(['title like' => '%'.$find.'%'])
        //         ->orWhere(['name like' => '%'.$find.'%'])
        //         ->orWhere(['content like' => '%'.$find.'%']);

        //     $posts_cnt = $this->Posts->find()
        //         ->where(['title like' => '%'.$find.'%'])
        //         ->orWhere(['name like' => '%'.$find.'%'])
        //         ->orWhere(['content like' => '%'.$find.'%'])
        //         ->count();
        // }
        // $this->set(compact('posts','find','posts_cnt'));
    // }


