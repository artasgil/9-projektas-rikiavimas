<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //numatytasis rikiavimas yra pagal id stulpeli nuo maziausio iki didziausio ('asc')
        //id - desc/asc
        //title = desc/asc
        //description - desc/asc
        //type - desc/asc

        // $companies = Company::all();

        // 1.isrikiuoti pagal id stulpeli desc
        // $companies = Company::orderBy('id', 'asc') ->get();
        // SELECT * FROM companies
        //WHERE 1
        //ORDER BY companies.id desc


        //2.true - mazejimo tvarka
        //false - didejimo tvarka
        // $companies = Company::all()->sortBy('id', SORT_REGULAR, true);
        //SELECT * FROM companies
        //Komanijos yra paverciamos i kolekcija/masyva
        //ir tada jau masyvas yra isrikiuojamas
        //su sita komanda maziau naudojama uzklausu.

        //3. SORT ir sortDesc komandos - jos dirba tai pat su kolekcija/masyvu
        //Sort rikiuoja pagal id didejimo tvarka
        // $companies = Company::all()->sort();
        //sortDesc rikiuoja pagal id mazejimo tvarka
        // $companies = Company::all()->sortDesc();



        //kolekcija - tas pats asociatyvus objektu masyvas, kuri galima filtruoti ir rikiuoti
        // SELECT * FROM COMPANIES
        //WHERE
        //ORDER BY(rikiavimas) stulpelis asc/dsc

        //Duomenu lentele
        //Turejome rikiavimo forma, kurioje perduodavome tuos pacius kintamuosius:
        //stulpelio pagal kuri rikiuosime, rikiavimo kryptis
        //GET metodu
        // SELECT * FROM companies
        //WHERE 1
        //ORDERBY $collumnName $sortby

        $collumnName = $request->collumnName;
        $sortby=$request->sortby;

        if(!$collumnName && !$sortby) {
            $collumnName = 'id';
            $sortby = 'asc';
        }

        // $companies = Company::orderBy($collumnName, $sortby) ->get();

        //puslapiavimas - paginate(15) - 15 yra kiek irasu per puslapi noriu matyti.
        // /simplepaginate(15) - pasikeicia i rodykles
        $companies = Company::orderBy($collumnName, $sortby) ->paginate(15);

        //'kabutese' kur columnName tai ci akoki varda suteikiame i index, o $columnName - cia requestas, kuris ateina is virsaus.
        return view('company.index', ['companies' => $companies, 'collumnName' => $collumnName, 'sortby' => $sortby]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //susikurti paieska
        //controlleryje galime kurti savo fukcijas
    }

    public function search(Request $request)
    {

        // $companies = Company::paginate(15);

        //SELECT * FROM companies
        //WHERE 1 //filtravimas

        //Company::orderBy('id','desc')->get(0);
        //SELECT * FROM companies
        //WHERE 1 //filtravimas
        //ORDER BY companies.id DESC


        //1. Atfiltruoti kompanijas pagal type_id 6

        $companies = Company::where("type_id", 6)->get();
        //SELECT * FROM companies
        //WHERE type_id = 6

        //2. ta pati komanda is kolekcijos puses
        // $companies = Company::all()->where("type_id", ">", 6);
        //SELECT * FROM companies WHERE 1
        //isideda i kolekcija
        //kolekcija yra filtruojama
        //Tinka naudoti db iki 10k irasu...

        // where("type_id",6)  Siuo atveju bus lygybe =
        // where("type_id", ">", 6)  Gauti duomenis, kurie yra daugiau negu 6


        //WHERE type_id > 16 && type_id < 150
        // $companies = Company::all()->where("type_id", ">", 6)->where("type_id", "<=", 150);


        //WHERE type_id = 151 OR type_id < 152
        // $companies = Company::query()->where("type_id", 16)->orWhere("type_id",18)->get();

        //SELECT * FROM companies
        //WHERE title LIKE %tekstas%

        $search = $request->search;
        $companies = Company::query()->sortable()->where("title", 'LIKE', "%{$search}%")->orWhere("description", 'LIKE', "%{$search}%")->paginate(30);



        return view("company.search", ['companies' => $companies]);


    }
}
