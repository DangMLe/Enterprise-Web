<?php
    namespace App\Controllers;

    use CodeIgniter\Controller;
    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use Psr\Log\LoggerInterface;
    use CodeIgniter\I18n\Time;
    
    class Files extends BaseController{
        public function index()
        {
            return view('welcome_message');
        }
        public function __construct(){
            parent::__construct();
            $this->load->model('files_model');
        }
        public function fileList($SubmitionID){
            $this->load->library('pagination');

            $data['fileRecords'] = $this->user_model->getSubmitionFiles($SubmitionID);

            $this->global['pageTitle'] = ' Files';
            $this->loadViews("Submition", $this->global, $data, NULL);
        }
        public function addFiles($SubmitionID){
            $input = $this->validate([
                'file' => [
                    'uploaded[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/png]',
                    'max_size[file,1024]',
                ]
            ]);
            if (!$input) {
                print_r('Choose a valid file');
            } else {
                $file = $this->request->getFile('file')->store();
                $file->move(WRITEPATH . 'uploads');
                
                $data = [
                   'FileName' =>  $file->getName(),
                   'SubmitionID' => $SubmitionID,
                   'FileType'  => $file->getClientMimeType()
                ];
        
                $result = $this->files_model->addFiles($data);
                if ($result == true) {
                    $this->session->set_flashdata('success', 'File has successfully uploaded');
                } else {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                redirect('Submition');
                      
            }
        }
        public function downloadFiles($SubmitionID){
            include_once('zip.php');
            $zip_file = Time::today(); // name for downloaded zip file

            $ziper = new zipfile();
            $ziper->prefix_name = Time::today(); // here you create folder which will contain downloaded files
            $row = $this->files_model->GetSubmitionsFile($SubmitionID);
            $ziper->addFiles($row["FilePath"]);  // array of files
            $ziper->output($zip_file); 
            $ziper->forceDownload($zip_file);
            @unlink($zip_file);
        }
        public function deleteFiles(){
            $FileId = $this->input->post('FileId');
            $result = $this->Files_model->deletFile($FileId);
            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
        public function viewtxtArticle($filePath){
            if(!file_exists($filePath)){
                $this->session->set_flashdata('error','No such file or directory');
            } else {
                echo file_get_contents($filePath);
            }
        }
        public function viewImage($filePath){
            if(!file_exists($filePath)){
                $this->session->set_flashdata('error','No such file or directory');
            } else {
                $imginfo = getimagesize($filePath);
                header("Content-type: {$imginfo['mime']}");
                readfile($filePath);
            }
        }
    }
?>