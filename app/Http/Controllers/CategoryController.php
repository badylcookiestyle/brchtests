<?php

namespace App\Http\Controllers;
use App\Http\Requests\categoryRequest;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    public function categoryFilter(categoryRequest $request)
    {
        //return $request;
        $category = $request->category;
        if (
            $request->sort_category == "Select" ||
            $request->sort_category == null
        ) {
            return Test::where("category", $category)
                ->where("name", "like", $request->text . "%")
                ->get();
        }
        $text = $request->text;
        if ($text == null || $text == "") {
            $text = "%";
        }
        if ($category != "Select category") {
            switch ($request->sort_category) {
                case "created_at":
                    return Test::where("category", $category)
                        ->where("name", "like", $text . "%")
                        ->orderBy("created_at", $request->sort_order)
                        ->get();
                    break;
                case "amount_of_solutions":
                    return Test::where("category", $category)
                        ->where("name", "like", $text . "%")
                        ->orderBy("amount_of_solutions", $request->sort_order)
                        ->get();
                    break;
                case "average_score":
                    return DB::select(
                        "SELECT tests.name, tests.id, tests.file_path, avg(tests_scores.score) as avg_score FROM tests LEFT JOIN tests_scores ON tests.id=tests_scores.test_id  where name is not null AND   name like '?%'  and  category=?  GROUP BY tests_scores.id ORDER BY avg_score ? ",
                        [$text, $category, $request->sort_order]
                    );
            }
        }

        switch ($request->sort_category) {
            case "created_at":
                return Test::where("name", "like", $request->text . "%")
                    ->orderBy("created_at", $request->sort_order)
                    ->get();
                break;
            case "amount_of_solutions":
                return Test::where("name", "like", $request->text . "%")
                    ->orderBy("amount_of_solutions", $request->sort_order)
                    ->get();
                break;
            case "average_score":
                return DB::select(
                    "SELECT tests.name, tests.id, tests.file_path, avg(tests_scores.score) as avg_score FROM tests LEFT JOIN tests_scores ON tests.id=tests_scores.test_id  where name is not null AND   name like '?%'   GROUP BY tests_scores.id ORDER BY avg_score ? ",
                    [$text, $request->sort_order]
                );
        }
    }
}
