<?php

namespace App\Models;

abstract class PostActivityType {
	const CreatedPost = 0;
	const ChangedStatus = 1;
	const DeletedPost = 2;
	const AddedComment = 3;
}
