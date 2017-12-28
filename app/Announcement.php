<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Announcement
 *
 * @property int $id
 * @property string $title
 * @property string $nice_url
 * @property string $description
 * @property float $latitude
 * @property float $longitude
 * @property string $address_short Short address e.g. only street name
 * @property string $address
 * @property int|null $max_persons maximum number of persons in flat
 * @property float $dimension dimensions in square meters of whole flat/house/room
 * @property string $phone
 * @property string $email
 * @property string|null $accepted_at
 * @property string|null $featured_till
 * @property int $announcement_type_id
 * @property int $user
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $active
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Amentity[] $amentities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AnnouncementImage[] $announcementImages
 * @property-read \App\AnnouncementType $announcementType
 * @property-read \App\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Place[] $places
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Rate[] $rates
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Announcement onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereAcceptedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereAddressShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereAnnouncementTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereDimension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereFeaturedTill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereMaxPersons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereNiceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Announcement whereUser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Announcement withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Announcement withoutTrashed()
 * @mixin \Eloquent
 */
class Announcement extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','description','latitude','longitude','address_short','address','max_persons','dimension','phone','email','user','announcement_type_id'];

    public function setTitleAttribute($value)
    {
        $this->attributes["title"] = $value;
        $this->attributes["nice_url"] = $value.rand(10000,99999);
    }

    public function rates(){
        return $this->hasMany('App\Rate','announcement_id','id');
    }

    public function author(){
        return $this->belongsTo('App\User','user','id');
    }

    public function announcementType(){
        return $this->belongsTo('App\AnnouncementType','announcement_type_id','id');
    }

    public function announcementImages(){
        return $this->hasMany('App\AnnouncementImage','announcement_id','id');
    }

    public function amentities(){
        return $this->belongsToMany('App\Amentity','announcement_amentities', 'announcement_id','amentity_id','id', 'id')->using('App\AnnouncementAmentity');
    }

    public function places(){
        return $this->belongsToMany('App\Place','place_in_hoods','place_id','announcement_id','id','id')->using('App\PlaceInHood');
    }

    public function setNiceURL(){
        $this->nice_url = preg_replace('/(-)+/','-',$this->clean($this->title) . "-" . $this->id.'-'.rand(10000,99999));
        return $this->save();
    }

    private function clean($string)
    {
        $utf8 = array(
            '/[áàâãªäąа]/u' => 'a',
            '/[ÁÀÂÃÄА]/u' => 'a',
            '/[б]/u' => 'b',
            '/[Б]/u' => 'b',
            '/[в]/u' => 'v',
            '/[В]/u' => 'v',
            '/[к]/u' => 'k',
            '/[К]/u' => 'k',
            '/[д]/u' => 'd',
            '/[Д]/u' => 'd',
            '/[є]/u' => 'ye',
            '/[Є]/u' => 'ye',
            '/[ж]/u' => 'zh',
            '/[Ж]/u' => 'zh',
            '/[ї]/u' => 'yee',
            '/[Ї]/u' => 'yee',
            '/[й]/u' => 'y',
            '/[Й]/u' => 'y',
            '/[п]/u' => 'p',
            '/[П]/u' => 'p',
            '/[р]/u' => 'r',
            '/[Р]/u' => 'r',
            '/[т]/u' => 't',
            '/[Т]/u' => 't',
            '/[у]/u' => 'u',
            '/[У]/u' => 'u',
            '/[хг]/u' => 'h',
            '/[ХГ]/u' => 'h',
            '/[ґ]/u' => 'g',
            '/[Ґ]/u' => 'g',
            '/[ш]/u' => 'sh',
            '/[Ш]/u' => 'sh',
            '/[ц]/u' => 'ts',
            '/[Ц]/u' => 'ts',
            '/[ч]/u' => 'ch',
            '/[Ч]/u' => 'ch',
            '/[щ]/u' => 'shch',
            '/[Щ]/u' => 'shch',
            '/[ф]/u' => 'f',
            '/[Ф]/u' => 'f',
            '/[я]/u' => 'ya',
            '/[Я]/u' => 'ya',
            '/[ÍÌÎÏИі]/u' => 'i',
            '/[íìîïиІ]/u' => 'i',
            '/[éèêëęе]/u' => 'e',
            '/[ÉÈÊËЕ]/u' => 'e',
            '/[óòôõºöо]/u' => 'o',
            '/[ÓÒÔÕÖО]/u' => 'o',
            '/[úùûü]/u' => 'u',
            '/[ÚÙÛÜ]/u' => 'u',
            '/[çć]/u' => 'c',
            '/[ÇĆ]/u' => 'c',
            '/śс/' => 's',
            '/ŚС/' => 's',
            '/łłłл/' => 'l',
            '/ŁŁЛ/' => 'l',
            '/[ñńн]/u' => 'n',
            '/[ÑŃН]/u' => 'n',
            '/[м]/u' => 'm',
            '/[М]/u' => 'm',
            '/[źżз]/u' => 'z',
            '/[ŹŻЗ]/u' => 'z',
            '/[ь]/u' => '',
            '/–/' => '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u' => ' ', // Literally a single quote
            '/[“”«»„]/u' => ' ', // Double quote
            '/ /' => '-', // nonbreaking space (equiv. to 0x160)
        );
        $string = preg_replace(array_keys($utf8), array_values($utf8), $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/(-){2,}/', '-', $string); // Removes special chars.
        $string = strtolower($string);
        return $string;
    }

}
