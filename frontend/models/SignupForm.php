<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Complemento;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $nome;
    public $data_nasc;
    public $altura;
    public $peso;
    public $meta_peso;
    public $obs;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['nome', 'required'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['data_nasc', 'required'],
            ['data_nasc', 'date', 'format' => 'php:Y-m-d'],

            ['altura', 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['peso', 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['meta_peso', 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

        ];
    }

    /**
     * Signs user up.
     *
     * @return array
     */

    public function attributeLabels()
    {

        return [
            'nome' => 'Name',
            'data_nasc' => 'Birthday Date',
            'altura' => 'Height',
            'peso' => 'Weight',
            'meta_peso' => 'Goal Weight'
        ];
    }

    public function signup()
    {
        if($this->validate()) {
            $user = new User();
            //$user = User::find()->where(['id' => 3])->one();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save(false);

            //the following three lines were added:
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('user');
            $auth->assign($authorRole, $user->getId());

            $complement = new Complemento();
            //$complement = Complemento::find()->where(['id_user' => 3])->one();
            $complement->id_user = $user->getId();
            //$complement->id_user = 3;
            $complement->nome = $this->nome;
            $complement->data_nasc = $this->data_nasc;
            $complement->peso = $this->peso;
            $complement->altura = $this->altura;
            $complement->meta_peso = $this->meta_peso;
            $complement->obs = $this->obs;
            $complement->save(false);

            return $user;
        }
        return null;
    }
}
