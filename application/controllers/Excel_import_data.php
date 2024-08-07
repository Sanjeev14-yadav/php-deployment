<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
require_once APPPATH . '../vendor/autoload.php';


class Excel_import_data extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('excel_import_model');
        
    }

    public function index(){
        $this->load->view('excel_import');
    }

    public function fetch(){
        $data = $this->excel_import_model->select(); 
        $output = '<div class="mt-5"><table class="table table-striped"><thead>
                    <tr>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Mobile No</th>
                        <th>DOB</th>
                        <th>Image</th>
                        <th>File</th>
                    </tr>
                    </thead>';
        if ($data->num_rows() > 0) {
            foreach($data->result() as $row) {
                $output .= '
                    <tr>
                        <td>'.$row->name.'</td>
                        <td>'.$row->lastname.'</td>
                        <td>'.$row->address.'</td>
                        <td>'.$row->emailid.'</td>
                        <td>'.$row->password.'</td>
                        <td>'.$row->mobileno.'</td>
                        <td>'.$row->dob.'</td>
                        <td>'.$row->image.'</td>
                        <td>'.$row->file.'</td>
                    </tr>';
            }
        } else {
            $output .= '<tr><td colspan="9" class="text-center">No data available</td></tr>';
        }
        $output .= '</table></div>';
        echo $output;
    }

    public function import(){
        if(isset($_FILES["file"]["name"])){
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size'] = 10000; // Adjust size if needed
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                echo $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $file_path = './uploads/'.$data['file_name'];

                $objPHPExcel = IOFactory::load($file_path);
                $worksheet = $objPHPExcel->getActiveSheet();
                $highestRow = $worksheet->getHighestRow();

                $excel_data = array();
                for($row = 2; $row <= $highestRow; $row++){
                    $name = $worksheet->getCell('A'.$row)->getValue();
                    $lastname = $worksheet->getCell('B'.$row)->getValue();
                    $address = $worksheet->getCell('C'.$row)->getValue();
                    $emailid = $worksheet->getCell('D'.$row)->getValue();
                    $password = $worksheet->getCell('E'.$row)->getValue();
                    $mobileno = $worksheet->getCell('F'.$row)->getValue();
                    $dob = $worksheet->getCell('G'.$row)->getValue();
                    $image = $worksheet->getCell('H'.$row)->getValue();
                    $file = $worksheet->getCell('I'.$row)->getValue();
                    
                    $excel_data[] = array(
                        'name' => $name,
                        'lastname' => $lastname,
                        'address' => $address,
                        'emailid' => $emailid,
                        'password' => $password,
                        'mobileno' => $mobileno,
                        'dob' => $dob,
                        'image' => $image,
                        'file' => $file
                    );
                }
                $this->excel_import_model->insert($excel_data);
                redirect('Excel_import_data');
                echo 'Data Imported Successfully';
            }
        } else {
            echo 'No file selected.';
        }
    }
}
