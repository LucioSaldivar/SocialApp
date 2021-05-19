<?php
declare(strict_types=1);

namespace SocialApp\views\Forms;

use SocialApp\views\MainView;

class Rating extends MainView
{

    public function getHtml(): string
    {
        return
            $this->mainHtml('<form id="createRating" method="POST" action="/save">
<p class="id">
        <label for="id">Id:</label>
        <input type="text" name="id" id="id">
    </p>
    <p class="socialType">
        <label for="socialType">Select Social Media type: </label>
        <select name="socialType" id="socialType">
            <option value="1">Twitter</option>
            <option value="2">Facebook</option>
            <option value="3">Instagram</option>
        </select>
    </p>
    <p class="name">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
    </p>
    <p class="comment">
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
    </p>
    <div class="rating">
        <label for="rating">Rating:</label>
        <input type="number" name="rating" id="rating"/>
    </div>
    <button type="submit" name="createRating" >Submit</button>
</form>');
    }
}