<?php 
class Topic
{
private $db;

public function __construct()
{
$this->db=new Database;
}
public function getAllTopics($s)
{
$this->db->query("SELECT topics.*,users.username,users.avatar,categories.name FROM topics
					INNER JOIN users 
					ON topics.user_id = users.id
					INNER JOIN categories 
					ON topics.category_id = categories.id
					WHERE topics.id>:s
					ORDER BY create_date DESC LIMIT 10");
					$this->db->bind(":s",$s);
					$results=$this->db->resultset();
					return $results;
}
public function getTopicsByCategory($category)
{
$this->db->query("SELECT topics.*,users.username,users.avatar,categories.name FROM topics
					INNER JOIN users 
					ON topics.user_id = users.id
					INNER JOIN categories 
					ON topics.category_id = categories.id
					WHERE topics.category_id=:category_id ORDER BY create_date DESC");
					$this->db->bind(':category_id',$category);
					$results=$this->db->resultset();
					return $results;
}
public function getCategoryName($category)
{$this->db->query("SELECT * FROM categories WHERE id= :category");
 $this->db->bind(':category',$category);
 return $this->db->single();
 
}

public function getTopicById($id)
{
$this->db->query("SELECT topics.*,users.username,users.name,users.avatar FROM topics
				INNER JOIN users 
				ON topics.user_id=users.id 
				WHERE topics.id=:topic_id");
		$this->db->bind(":topic_id",$id);
		return $this->db->single();
}
public function getTopicBySearch($id)
{
$this->db->query("SELECT topics.*,users.username,users.name,users.avatar FROM topics
				INNER JOIN users 
				ON topics.user_id=users.id 
				WHERE users.username=:name ORtopics.title=:topic_id ");
		$this->db->bind(":topic_id",$id);
		return $this->db->single();
}
public function getRepliesByTopic($topic_id)
{$this->db->query("SELECT replies.*,users.username,users.email,users.about,users.name,users.avatar FROM replies
					INNER JOIN users 
					ON replies.user_id=users.id 
					WHERE replies.topic_id=:topic_id ORDER BY create_date DESC");
				$this->db->bind(":topic_id",$topic_id);
				return $this->db->resultset();
}
public function getPostsByUserId($id)
{$this->db->query("SELECT topics.*,users.username,users.avatar,categories.name FROM topics
					INNER JOIN users 
					ON topics.user_id = users.id
					INNER JOIN categories 
					ON topics.category_id = categories.id
					WHERE topics.user_id=:user_id ORDER BY create_date DESC");
					$this->db->bind(':user_id',$id);
					$results=$this->db->resultset();
					return $results;
}
public function userName($id)
{$this->db->query("SELECT * FROM users WHERE id=:user_id");
$this->db->bind('user_id',$id);
return $this->db->single();
}
}
?>