<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
// for delete imgs
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;


class PostsController extends AppController
{
    public $paginate = [
            'limit' => 5,
            'order' => [
                'id' => 'DESC']
        ];
    public $components = array(
            'ImgProcess' => array()
        );

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    public function index() {
        $data = $this->paginate($this->Posts);
        $this->set('data', $data);
        $this->set('count', $data->count());
        }

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



    public function view($postId = null)
    {
        $new_post = $this->Posts->newEntity();
        $data = $this->Posts->find()
        ->where(['postId =' => $postId])
        ->order(['resId' => 'asc']);

        $this->set(compact('data', 'new_post'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            if (!empty($this->request->data['img']['name'])) {
                $this->ImgProcess->save($this->request);
            }
            $data = $this->Posts->patchEntity($data, $this->request->getData());
            if ($data->postId == -1) {
                $data->postId = $this->Posts->find()
                ->order(['postId' => 'desc'])
                ->select(['postId'])
                ->first()['postId'] +1;
                $data->resId = 0;
            }
            if($data->name === '') $data->name = 'No name';
            if ($this->Posts->save($data)) {
                if (!empty($this->request->data['img']['name'])) {
                    $this->ImgProcess->generate(
                        $this->request->data['img']['tmp_name'], $data);
                }
                $this->Flash->success(__('The post has been saved.'));
                if($data->resId === 0) return $this->redirect(['action' => 'index']);
                else return $this->redirect($this->referer());
            } else {
                if ($data->errors()['img_ext'])
                    $this->Flash->error(__($data->errors()['img_ext']['list']));
                if ($data->errors()['img_size'])
                    $this->Flash->error(__($data->errors()['img_size']['comparision']));
                $this->Flash->error(__('The post could not be saved. Please, try again.'));
                return $this->redirect($this->referer());
            }
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
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
        $data = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->Posts->patchEntity($data, $this->request->getData());
            if ($this->Posts->save($data)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $del_post = $this->Posts->get($id);
        if ($del_post->resId === 0) {
            $query = $this->Posts->find()
                ->where(['postId =' => $del_post->postId])
                ->select(['img_name']);
            $del_imgs = [];
            foreach ($query as $q) array_push($del_imgs, $q->img_name);
            if ($this->Posts->deleteAll(array('postId' => $del_post->postId))) {
                foreach ($del_imgs as $q) {
                    $file = new File(WWW_ROOT.'img/'.$q);
                    $file->delete();
                    $file = new File(WWW_ROOT.'img/mini'.$q);
                    $file->delete();
                }
                $this->Flash->success(__('The post has been deleted.'));
            } else {
                $this->Flash->error(__('The post could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        } elseif ($this->Posts->delete($del_post)) {
                    $file = new File(WWW_ROOT.'img/'.$q);
                    $file->delete();
                    $file = new File(WWW_ROOT.'img/mini'.$q);
                    $file->delete();
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


