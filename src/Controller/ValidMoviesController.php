<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ValidMovies Controller
 *
 * @property \App\Model\Table\ValidMoviesTable $ValidMovies
 *
 * @method \App\Model\Entity\ValidMovie[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ValidMoviesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $validMovies = $this->paginate($this->ValidMovies);

        $this->set(compact('validMovies'));
    }

    /**
     * View method
     *
     * @param string|null $id Valid Movie id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $validMovie = $this->ValidMovies->get($id, [
            'contain' => [],
        ]);

        $this->set('validMovie', $validMovie);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $validMovie = $this->ValidMovies->newEntity();
        if ($this->request->is('post')) {
            $validMovie = $this->ValidMovies->patchEntity($validMovie, $this->request->getData());
            if ($this->ValidMovies->save($validMovie)) {
                $this->Flash->success(__('The valid movie has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The valid movie could not be saved. Please, try again.'));
        }
        $this->set(compact('validMovie'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Valid Movie id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $validMovie = $this->ValidMovies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $validMovie = $this->ValidMovies->patchEntity($validMovie, $this->request->getData());
            if ($this->ValidMovies->save($validMovie)) {
                $this->Flash->success(__('The valid movie has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The valid movie could not be saved. Please, try again.'));
        }
        $this->set(compact('validMovie'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Valid Movie id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $validMovie = $this->ValidMovies->get($id);
        if ($this->ValidMovies->delete($validMovie)) {
            $this->Flash->success(__('The valid movie has been deleted.'));
        } else {
            $this->Flash->error(__('The valid movie could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
