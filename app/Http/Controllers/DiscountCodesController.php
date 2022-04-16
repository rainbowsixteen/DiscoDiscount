<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodesController extends Controller
{
    /**
     * Endpoint for allowing brands to add new discount codes to our database
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function createNewDiscountCodes(Request $request)
    {
        //Validate the input
        $validatedInput = $request->validate([
            'brandId' => 'required|int',
            'amount' => 'required|int'
        ]);

        for ($newCodesGenerated = 0; $newCodesGenerated <= (int)$validatedInput['amount']; $newCodesGenerated++) {
            //Generates a random 45 character string, the actual discount code
            $discountCode = substr(bin2hex(random_bytes(45)),-45);
            //Creating the db object for the discount code
            $discountCode = DiscountCode::create([
                'discount_code_id' => $discountCode,
                'brands_id' => (int)$validatedInput['brandId']
            ]);

            //Save the db object to the db and put it in a return-array
            $discountCode->save();
            $return[] = $discountCode;
        }

        //Return the array with newly generated discount codes in case we want to print them in the UI afterwards
        return $return;
    }

    /**
     * Endpoint for users to get a discount code
     *
     * @param Request $request
     * @return mixed
     */
    public function connectCodeToUser(Request $request)
    {
        //Validate the input
        $validatedInput = $request->validate([
            'brandId' => 'required|int',
            'userId' => 'required|int'
        ]);

        //Find the first unclaimed discount code for the brand
        $discountCode = DiscountCode::where('brands_id',$validatedInput['brandId'])
            ->where('users_id',null)
            ->first();

        //Bind the discount code to the user and save change to db
        $discountCode->users_id = $validatedInput['userId'];
        $discountCode->save();

        //Return the discount code object to the endpoint so that front end can show it to the user
        return $discountCode;
    }
}
