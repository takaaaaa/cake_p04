<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
	    'username' => array(
	        'notEmpty' => array(
	            'rule' => array('notEmpty'),
	            //'message' => 'Your custom message here',
	            //'allowEmpty' => false,
	            //'required' => false,
	            //'last' => false, // Stop validation after this rule
	            //'on' => 'create', // Limit validation to 'create' or 'update' operations
	        ),
	    ),
	    'email' => array(
	        'email' => array(
	            'rule' => array('email'),
	            //'message' => 'Your custom message here',
	            //'allowEmpty' => false,
	            //'required' => false,
	            //'last' => false, // Stop validation after this rule
	            //'on' => 'create', // Limit validation to 'create' or 'update' operations
	        ),
	    ),
	    'password' => array(
	        'notEmpty' => array(
	            'rule' => array('notEmpty'),
	            //'message' => 'Your custom message here',
	            //'allowEmpty' => false,
	            //'required' => false,
	            //'last' => false, // Stop validation after this rule
	            //'on' => 'create', // Limit validation to 'create' or 'update' operations
	        ),
	    ),
	);

	/**
	 * beforeSave method
	 *
	 * @param  array $options
	 * @return boolean
	 */
	public function beforeSave($options = array()) {

	    parent::beforeSave($options);
	    //、find結果のモデル名部分は、Modelクラスの alias プロパティに設定されている値を使っています。
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
	    }

	    return true;
	}
}
