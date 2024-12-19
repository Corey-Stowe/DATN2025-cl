<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'banners';

    protected $fillable = [
        'img_banner',
        'link',
        'banner_position',
        'created_at',
        'updated_at',
        'deleted_at',
        'offer_text',
        'title',
        'description',
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }
    public function getBanner()
    {
        return $this->all();
    }
    
    public function Addbanner( $image, $link, $banner_position, $offer_text, $title, $description)
    {
        return $this->insert([
            'img_banner' => $image,
            'link' => $link,
            'banner_position' => $banner_position,
            'offer_text' => $offer_text,
            'title' => $title,
            'description' => $description,
        ]);
    }
    public function updateBanner($id, $image, $link, $banner_position, $offer_text, $title, $description)
    {
        return $this->where('id', $id)->update([
            'img_banner' => $image,
            'link' => $link,
            'banner_position' => $banner_position,
            'offer_text' => $offer_text,
            'title' => $title,
            'description' => $description,
        ]);
    }
    public function updateBannerNoImg($id, $link, $banner_position, $offer_text, $title, $description)
    {
        return $this->where('id', $id)->update([
            'link' => $link,
            'banner_position' => $banner_position,
            'offer_text' => $offer_text,
            'title' => $title,
            'description' => $description,
        ]);
    }
    public function deleteBanner($id)
    {
        return $this->where('id', $id)->delete();
    }
    public function getSliderPosition()
    {
        return $this->where('banner_position', 1)->get();
    }
    public function getTopPosition()
    {
        return $this->where('banner_position', 2)->get();
    }
    public function getCenterPosition()
    {
        return $this->where('banner_position', 3)->get();
    }
    public function getBottomPosition()
    {
        return $this->where('banner_position', 4)->get();
    }
}
