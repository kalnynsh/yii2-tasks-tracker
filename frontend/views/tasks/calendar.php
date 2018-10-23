<?php
/** @var array $calendar */
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php echo $this->render('_profile', ['profile' => $profile]); ?>

<div>
    <?= Yii::t('app', 'Current date: {0, date, dd MMMM yyyy}', time()); ?>
</div>
<div class="table-responsive">
    <table class="table table-striped">   
        <tr>
            <td>
                <?= Yii::t('app', 'Date of month'); ?>
            </td>
            <td><?= Yii::t('app', 'Event'); ?></td>
            <td><?= Yii::t('app', 'Deadline'); ?></td>
            <td><?= Yii::t('app', 'Status'); ?></td>
            <td><?= Yii::t('app', 'Total events'); ?></td>
        </tr>
        <?php foreach ($calendar as $day => $events) : ?>
            <tr class="<?=(count($events) > 0)?'warning' : ''?>">
                <td class="td-date"><span class="label label-success"><?=$day;?></span></td>
                <td>
                    <?=(count($events) > 0) ?
                    '<p>'
                        . ucfirst($events[0]->title)
                    . '</p>'
                    .'<p class="small">' .
                        ucfirst($events[0]->description)
                    . '</p>'
                        : '-';
                    ?>
                </td>
                <td>
                <?= (count($events) > 0) ?
                '<p class="warning">' . Yii::$app->formatter->asDate($events[0]->deadline) . '</p>'
                    : '-';
                ?>
                </td>
                <td>
                    <?php if (count($events) > 0) : ?>
                    <p>
                        <?php echo ($events[0]->status == 10) ? 'Active' : 'Not active'; ?>
                    </p>
                    <?php else : ?>
                    <p> - </p>
                    <?php endif; ?>
                </td>
                <td class="td-event">
                    <?= (count($events) > 0) ? Html::a(
                        count($events),
                        Url::to(['tasks/view', 'id' => $events[0]->id])
                    ) : '-';
                    ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
