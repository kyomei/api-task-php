<?php
class ApiController extends Controller
{
	public function index()
	{
        echo "Nossa API Restful";
	}

	public function list($id = null) {
        
        $t = new Tarefas();
        // Se for passado um $id retorna 1 registro caso contrário retorna todos
        if (!empty($id) && is_numeric($id)) {
            $task = $t->find($id) ? $t->find($id) : array('status' => 'error', 'message' => 'Registro não encontrado!');
        } else {
            $task = $t->list();
        }

        header("Content-Type: application/json");
        echo json_encode($task);
    }

    public function add () {
        if (!empty($_POST['titulo'])) {
            $titulo = addslashes($_POST['titulo']);

            $task = new Tarefas();
            if ($result = $task->add($titulo)) {
                echo json_encode(array('status' => 'success' , 'message' => 'Registro adicionado com sucesso!'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        }
    }

    public function delete($id) {
        if (!empty($id)) {
            $task = new Tarefas();
            if ($task->delete($id)) {
                $response = array('status' => 'success', 'message' => 'Registro excluído com sucesso!');
            } else {
                $response = array('status' => 'error', 'message' => 'Não foi possível excluir o registro');
            }

            header("Content-Type: application/json");
            echo json_encode($response);
        }
    }

    public function edit() {
        if (!empty($_POST['id']) && is_numeric($_POST['id'])) {
            $id = intval($_POST['id']);
            $status = intval($_POST['status']);
            
            $task = new Tarefas();
            if ($task->updateStatus($status, $id)) {
                $response['status'] = 'success';
                $response['message'] = 'Status alterado com sucesso!';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Não foi possível alterar o status';
            }

            header("Content-Type: application/json");
            echo json_encode($response);
        }
    }
}