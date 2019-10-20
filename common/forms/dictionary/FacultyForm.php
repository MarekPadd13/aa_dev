<?php
namespace common\forms\dictionary;
use common\models\dictionary\Faculty;
use yii\base\Model;

class FacultyForm  extends Model
{
    public  $full_name;
    /**
     * {@inheritdoc}
     */
    public function __construct(Faculty $faculty = null, $config = [])
    {
        if($faculty) {
            $this->full_name = $faculty->full_name;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['full_name', 'required'],
            ['full_name', 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return  Faculty::labels();
    }

}