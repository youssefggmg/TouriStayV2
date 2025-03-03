<?php 
namespace App\View\Components\Tourist;

use Illuminate\View\Component;

class TouristPagination extends Component {
    public function render(){
        return view('components.tourist.touristBagination');
    }
}