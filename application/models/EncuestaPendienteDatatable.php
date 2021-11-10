<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EncuestaPendienteDatatable extends CI_Model { 

   public function get_datatables_query()
   {
      $this->db->select($this->select);
      $this->db->from($this->table);   
      $this->db->where('(SELECT ec.idEstado FROM encuestas_clientes ec WHERE idEncuesta = 21 && idCliente = clientes.idCliente) IS NULL', null, false);      
      $this->db->or_where('(SELECT ec.idEstado FROM encuestas_clientes ec WHERE idEncuesta = 21 && idCliente = clientes.idCliente && idEstado = 1)', null, false);      
      foreach ($this->where as $key => $where) {
         if(isset($where[2])) {
            $this->db->where($where[0], null, false);    
         }else {
            $this->db->where($where[0], $where[1]);       
         }        
      }
      if(count($this->tableJoin) > 0){
         foreach($this->tableJoin as $table => $data) {
            $this->db->join($table, $table .'.'.$data['id'].' = ' . $this->table . ".".$data['selfId'], 'left');
            if(isset($data['tableJoin'])) {
               foreach($data['tableJoin'] as $table2 => $data2) {
                  $this->db->join($table2, $table2 .'.'.$data2['id'].' = ' . $table . '.' .$data2['selfId'], 'left');
                  if(isset($data2['tableJoin'])) {
                     foreach($data2['tableJoin'] as $table3 => $data3) {
                        $this->db->join($table3, $table3 .'.'.$data3['id'].' = ' . $table2 . '.' .$data3['selfId'], 'left');
                     }               
                  }
               }               
            }
         }
      }/*else{
      //    $this->db->from($this->table);
      // } */     

      $i = 0;

      foreach($this->column_search as $key => $item){
         if($_POST['search']['value']){
            if($i === 0){
               $this->db->group_start();
               $this->db->like($item, $_POST['search']['value']);
            }else{
               $this->db->or_like($item, $_POST['search']['value']);
            }

            if(count($this->column_search) - 1 === $i){
               $this->db->group_end();
            }
         }

         $i++;
      }

      $i = 0;
      // Sarch for specific column
      foreach($this->column_search as $key => $item){
         if($_POST['columns'][$key]['search']['value']){
            if($i === 0){
               $this->db->group_start();
            }
            $this->db->like($item, 
            $_POST['columns'][$key]['search']['value']);
              
            $i++;           
         }           
      }

      if($i > 0) $this->db->group_end();



      if(isset($_POST['order'])){
         $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      }else if(isset($this->order)){
         $order = $this->order;
         $this->db->order_by(key($order), $order[key($order)]);
      }
   }

   public function get_datatables()
   {
      $this->get_datatables_query();
      
      if($_POST['length'] != -1){
         $this->db->limit($_POST['length'], $_POST['start']);
      }
       
      return $this->db->get()->result();
   }

   public function count_filtered()
   {
      $this->get_datatables_query();
      return $this->db->get()->num_rows();
   }

   public function count_all()
   {
      $this->db->from($this->table);
      return $this->db->count_all_results();
   }

   public function countRows($table)
   {
      return $this->db->get($table)->num_rows();
   }

   public function get_by_id($id)
   {
      $this->db->from($this->table);
      $this->db->where($this->id, $id);
      return $this->db->get()->row();
   }

   public function delete($id){
      $this->db->where($this->id, $id);
      $this->db->delete($this->table);
   }

   public function save($data){
      $this->db->insert($this->table, $data);
   }

   public function update($where, $data){
      $this->db->update($this->table, $data, $where);
      return $this->db->affected_rows();
   }   

}

/* End of file My_Model.php */
