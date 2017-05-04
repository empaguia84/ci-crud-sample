<?php
class MY_Form_validation extends CI_Form_validation{
	//http://stackoverflow.com/questions/27621250/is-unique-in-codeigniter-for-edit-function
    public function edit_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id))->num_rows() === 0)
            : FALSE;
    }

}