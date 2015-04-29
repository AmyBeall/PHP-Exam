<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend extends CI_Model {

	function add($data)
	{
		$query = "INSERT INTO users (name, alias, email, password, birthdate, created_at, updated_at) VALUES(?,?,?,?,?, NOW(), NOW())";
		$values = array($data['name'], $data['alias'], $data['email'], $data['password'], $data['birthdate']);
			return $this->db->query($query, $values);
	}

	function check($data)
	{
		$query = "SELECT * FROM users WHERE users.email = '{$data['email']}' AND users.password = '{$data['password']}'";
			return $this->db->query($query)->row_array();
	}
	function get_user_by_id($id)
	{
		$query = "SELECT * FROM users WHERE users.id = {$id} ";
			return $this->db->query($query)->row_array();
	}
	function get_friends($id)
	{
		$query = "SELECT friend.alias, friend.id AS id, friendships.user_id, friendships.friend_id FROM friendships 
				JOIN users AS friend ON friendships.friend_id = friend.id
				WHERE friendships.user_id = {$id}";
			return $this->db->query($query)->result_array();
	}
	function all_users($id)
	{
		$query = "SELECT * FROM users WHERE users.id != {$id} ";
			return $this->db->query($query)->result_array();
	}
	function not_friends($id)
	{
		$query = "SELECT users.* FROM users 
				WHERE users.id != $id";
			return $this->db->query($query)->result_array();
	}
	function add_friend($data)
	{
		$query = "INSERT INTO friendships (user_id, friend_id) VALUES(?, ?)";
		$values = array($data['user_id'], $data['friend_id']);
			return $this->db->query($query, $values);
	}
	function delete_friend($data)
	{
		$query = "DELETE FROM friendships WHERE friendships.user_id = {$data['user_id']} AND friendships.friend_id ={$data['friend_id']}";
		return $this->db->query($query);
	}
}
//end of main controller