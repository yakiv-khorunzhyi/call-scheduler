<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property string $_id
 * @property int    $time
 * @property string $text
 * @property string $phone
 * @property bool   $is_completed
 * @property string $updated_at
 * @property string $created_at
 * @method static Call create(array $data)
 * @method static Call findOrFail(array $data)
 * @method static null|Call first()
 */
class Call extends Model
{
    protected $primaryKey = '_id';

    protected $collection = 'calls';

    protected $fillable = [
        'phone',
        'text',
        'time',
        'is_completed',
    ];

    protected $casts = [
        'phone'        => 'encrypted',
        'text'         => 'encrypted',
        'is_completed' => 'bool',
    ];

    ////////////////////////////////////////////////////////////////////////////////////

    public function getDateTimeString(): string
    {
        return Carbon::createFromTimestamp($this->time, env('TIMEZONE'))->format('Y:m:d H:i:s');
    }

    public function complete(): self
    {
        $this->is_completed = true;

        return $this;
    }

    ////////////////////////////////////////////////////////////////////////////////////

    protected function phone(): Attribute
    {
        return $this->getAccessorsAndMutatorsForEncryptedFields();
    }

    protected function text(): Attribute
    {
        return $this->getAccessorsAndMutatorsForEncryptedFields();
    }

    private function getAccessorsAndMutatorsForEncryptedFields(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Crypt::decryptString($value),
            set: fn(string $value) => Crypt::encryptString($value),
        );
    }
}
