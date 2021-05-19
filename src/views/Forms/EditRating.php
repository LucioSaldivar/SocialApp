<?php
declare(strict_types=1);

namespace SocialApp\views\Forms;

use SocialApp\Model\SocialRatingModel;
use SocialApp\views\MainView;

class EditRating extends MainView
{

    public function getHtml(SocialRatingModel $rating): string
    {
        return
            $this->mainHtml('<form id="editRating" method="PUT" action="/save">
<p class="id">
        <label for="id">Id:</label>
        <input hidden="hidden" type="text" value='.$rating->getId().' name="id" id="id">
    </p>
    <p class="socialType">
        <label for="socialType">Select Social Media type: </label>
        <select name="socialType" id="socialType" value='.$rating->getSocialType().'>
            <option value="1">Twitter</option>
            <option value="2">Facebook</option>
            <option value="3">Instagram</option>
        </select>
    </p>
    <p class="name">
        <label for="name">Name:</label>
        <input type="text" value='.$rating->getName().' name="name" id="name">
    </p>
    <p class="comment">
        <label for="comment">Comment:</label>
        <textarea name="comment" value='.$rating->getComment().' id="comment" cols="30" rows="10"></textarea>
    </p>
    <div class="rating">
        <label for="rating">Rating:</label>
        <input type="number" value='.$rating->getRating().' name="rating" id="rating"/>
    </div>
    <button type="submit" name="editRating" >Submit</button>
</form>');
    }
}