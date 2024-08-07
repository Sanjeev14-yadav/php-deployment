<?php


             
class Crud_model extends CI_Model{


public function registration($data)
{
	return $this->db->insert('registration', $data);
}
// this method will check the correct email for login -match karega email registered hai ya nahi.


public function login_check($Email_Id) {
	$this->db->where('Email_Id', $Email_Id);
	$query = $this->db->get('registration');

	if ($query->num_rows() == 1) {
		return $query->row();
	} else {
		return false;
	}
}
			
public function getAllEmployee(){

	$query = $this->db->get('employee');
	if($query){
		return $query->result();
	}
}
public function insertEmpdata($data){
	$query = $this->db->insert('employee',$data);
	if($query){
		return true;
	}
	else{
		return false;
	}
}
public function resetAutoIncrement() {
        $query = $this->db->query("ALTER TABLE employee AUTO_INCREMENT = 1");
        return $query;
    }
public function deleteitem($id){
	$this->db->where('id', $id);
	$query = $this->db->delete('employee');

	if($query){
		return true;
	}
	else{
		return false;
	}
}

// niche fuction se humne data fetch karke update kar ke db me save karne ke liye model banaya hai.
public function getsingleEmp($id){
	$this->db->where('id', $id);
		$query = $this->db->get('employee');

	if($query){
		return $query->row();
	}
	else{
		return false;
	}
}
public function updateEmpdata($id, $data){
	
	        // Check if the 'password' column exists in the table
    if (!$this->db->field_exists('password', 'employee')) {
            // Dynamically add the 'password' column to the table----automatically password naame se column bana lega database me.
        $this->db->query("ALTER TABLE employee ADD COLUMN password VARCHAR(255)");
    }
    // Perform the update operation
	$this->db->where('id', $id);

	$query = $this->db->update('employee',$data);

	if($query){
		return true;
	}
	else{
		return false;
	}
}

public function getEmployeeData($search_query = '', $filter_option = '')
{
    // Base query to fetch all employee data
    $this->db->select('*');
    $this->db->from('employee');

    // Apply search query if provided
    if (!empty($search_query)) {
		$this->db->group_start();
		$this->db->like('Emp_name', $search_query);
		$this->db->or_like('emp_role', $search_query);
		$this->db->or_like('Department', $search_query);
		$this->db->or_like('Email_Id', $search_query);
		$this->db->or_like('Mobile_Number', $search_query);
		$this->db->or_like('password', $search_query);
		$this->db->or_like('file', $search_query);
		$this->db->or_like('image', $search_query);
		$this->db->group_end();

        // Add more fields to search as needed
    }

    // Apply filter option if provided
    if (!empty($filter_option)) {
        // Add conditions based on filter option
        // Example: $this->db->where('field_name', $filter_option);
		$this->db->where('id', $filter_option);
		$this->db->where('Emp_name', $filter_option);
		$this->db->where('emp_role', $filter_option);
		$this->db->where('Department', $filter_option);
		$this->db->where('Email_Id', $filter_option);
		$this->db->where('Mobile_Nmuber', $filter_option);
		$this->db->where('password', $filter_option);
		$this->db->where('file', $filter_option);
		$this->db->where('image', $filter_option);
    }

    // Execute the query and return the result
    return $this->db->get()->result();
}
	//for pagination -----------
	public function countEmployeeData()
	{
    	return $this->db->count_all('employee');
	}

	public function getEmployeeDatapage($limit, $offset)
	{
    	return $this->db->get('employee', $limit, $offset)->result();
	}

	// for uploading and saving image into db ----------------------upload image---
	
	public function save_image_data($image_path) {
			// Insert the image path into the database
		$data = array(
			'image' => $image_path
		);
		$this->db->insert('employee', $data);
		
	}
	

}
?>