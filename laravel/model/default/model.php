<?php
/**
 * This is the template for generating the model class of a specified table.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

echo "<?php\n";
?>

<?php if ($generator->ns) : ?>
namespace <?= $generator->ns ?>;
<?php endif; ?>

/**
 * This is the model class for table "<?= $tableName ?>".
 *
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation['class'] . ' $' . lcfirst($name) . ($relation['hasMany'] ? '[]' : '') . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{

<?php if (isset($tableSchema->columns['deleted_at'])) : ?>
    use SoftDeletingTrait;
<?php endif; ?>

    /**
    * The database connection used by the model.
    *
    * @var string
    */
    //protected $connection = '<?= $generator->db ?>';

    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = '<?= $generator->generateTableName($tableName) ?>';

    <?php
    $fillable = array();
    $guarded = array();
    foreach ($tableSchema->columns as $column) {
        if (!$column->autoIncrement) {
            $fillable[] = "'".$column->name."'";
        } else {
            $guarded[] = "'".$column->name."'";
        }
    }
    ?>

    /**
    * Fields that are allowed to be mass assigned
    *
    * @var string
    */
    protected $fillable = [<?=implode(', ', $fillable)?>];

    /**
    * Fields that are NOT allowed to be mass assigned
    *
    * @var string
    */
    protected $guarded = [<?=implode(', ', $guarded)?>];

    /**
     * Rules to be used with validator
     *
     * @var array
     */
    public $rules = [
<?php foreach ($rules as $ruleColumn => $rule) { echo "        '$ruleColumn' => '$rule',\n"; } ?>
    ];

    /**
     * Rules used in different cases
     *
     * @var array
     */
    public $rulesets = [
        'creating' => [
        ],
        'updating' => [
        ],
        'deleting' => [
        ],
        'saving' => [
        ]
    ];

    /**
     * List of human readable attribute names for use with a validator.
     *
     * @var array
     */
    public $validationAttributeNames = [
<?php foreach ($labels as $name => $label): ?>
        <?= "'$name' => " . $generator->generateString($generator->enableI18N?$name:$label) . ",\n" ?>
<?php endforeach; ?>
    ];

<?php foreach ($relations as $name => $relation): ?>

    /**
     * @return <?= $name ?>
     */
    public function <?= $name ?>()
    {
        <?= $relation['relation'] . "\n" ?>
    }
<?php endforeach; ?>
}