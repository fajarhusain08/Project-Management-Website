else {

$tes = $this->input->post('user_ids');
$gabung = '';

foreach ($tes as $value) {
$gabung .= $value;
$gabung .= ',';
}
$gabung = substr($gabung, 0, -1);

#$gabung = $this->input->post('user_ids')[0] . ", " . $this->input->post('user_ids')[1];

$data = [
'name' => $this->input->post('name'),
'status' => $this->input->post('status'),
'start_date' => $this->input->post('start_date'),
'end_date' => $this->input->post('end_date'),
'manager_id' => $this->input->post('manager_id'),
'user_ids' => $gabung,
'description' => $this->input->post('description'),
'date_created' => $date
];
var_dump($data);
$this->db->insert('project', $data);
$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    New Project added!</div>');
redirect('project');
}