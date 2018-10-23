<?php

namespace common\models\project;

/**
 * This is the ActiveQuery class for [[Project]].
 *
 * @see Project
 */
class ProjectQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status_id]]=10');
    }

    /**
     * {@inheritdoc}
     * @return Project[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Project|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
