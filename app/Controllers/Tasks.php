<?php

namespace App\Controllers;

use App\Entities\Task;

class Tasks extends BaseController
{
	private $model;

	public function __construct() 
	{
		$this->model = new \App\Models\TaskModel;

	}
	public function index()
	{
		$data = $this->model->findAll();
	
		return view("Tasks/index", ['tasks' => $data]);
	}

	public function show($id)

	{
	
	$task = $this->getTaskOr404($id);

	return view('tasks/show', [
		'task' => $task
	]);
	

	}

	public function new()
	{
		$task = new Task;
		return view('Tasks/new', [
			'task' => $task
		]);
	}

	public function create()
	{
		$task = new Task($this->request->getpost());

		if ($this->model->insert($task)){
			return redirect()->to("/tasks/show/{$this->model->insertID}")
		                 ->with('info', 'Task created successfully');
						  	 
		} else {
			return redirect()->back()
			->with('errors', $this->model->errors())
			->with('warning', 'Invalid data')
			->withInput();
		
	}
	}
	public function edit($id)
	{
		$task = $this->getTaskOr404($id);

	return view('tasks/edit', [
		'task' => $task
	]);

	}

	public function update($id)
	{
		$task = $this->getTaskOr404($id);

		$task->fill($this->request->getPost());

		if (! $task->hasChanged()){
			return redirect()->back()
				            ->with('warning', 'Nothing to update')
							->withInput();
		
		}

		if ($this->model->save($task)) {

		return redirect()->to("tasks/show/$id")
		                 ->with('info', 'task updated successfully');

		} else {
			return redirect()->back()
				             ->with('errors', $this->model->errors())
							 ->with('warning', 'Invalid data')
							 ->withInput();
		}
	}

	public function delete($id)
	{
		$task = $this->getTaskOr404($id);

		if ($this->request->getMethod() === 'post') {
 
			$this->model->delete($id);
			 
			return redirect()->to('/tasks')
			 	 			 ->with('info', 'Task deleted');
		}
		return view('Tasks/delete', [
			'task' => $task
		]);
	}
   
	private function getTaskOr404($id) 
	{
		$task = $this->model->find($id);

	if ($task == null) {

		throw new \CodeIgniter\Exceptions\PageNotFoundException("task with id $id not found");
	}

	return $task;
	}

}