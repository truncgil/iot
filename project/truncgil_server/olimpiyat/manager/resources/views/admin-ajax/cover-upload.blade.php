<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contents;

use Illuminate\Support\Facades\DB;

		$post = $request->all();

		$ext = $request->cover->getClientOriginalExtension();

		$path = $request->cover->storeAs('files/'.date("Y")."/".date("m"),$request['slug']."-".date("his").'.'.$ext);

		$path = str_replace("files/","",$path);
		$table = "contents";
		if($request->has("table")) {
			$table = $request->table;
		}
		DB::table($table)

            ->where('id', $post['id'])

            ->update(["cover" => $path]);

		$return = back();

		echo $return;

		