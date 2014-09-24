<?php

class DocumentsController extends \BaseController {

	/**
	 * Display a listing of documents
	 *
	 * @return Response
	 */
	public function index()
	{
		$documents = Document::orderBy('created_at','desc')->with('fromUnit')->paginate(5);


		return View::make('documents.index', compact('documents'));
	}

	/**
	 * Show the form for creating a new document
	 *
	 * @return Response
	 */
	public function create()
	{
        $units = Unit::orderBy('unit_type')->lists('name','id');
		return View::make('documents.create',compact('units'));
	}

	/**
	 * Store a newly created document in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make($data = Input::except('_token','to_units_id'), Document::$rules);


        //files upload
        $files = Input::file('files');
        //var_dump($files);exit;
        $filesName = array();
        foreach($files as $file) {
            if(isset($file)){
                // public/uploads
                $file->name = uniqid()."_".$file->getClientOriginalName();
                $filesName[] = $file->name;
                $file->move('uploads/',$file->name);
            }
        }

        $data['files'] = json_encode($filesName);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$doc = Document::create($data);

        //dump pivot table units to
        $units = Input::get('to_units_id');
        if (count($units)){
            $doc->units()->attach($units);
        }


        return Redirect::route('documents.index');
	}

	/**
	 * Display the specified document.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$document = Document::findOrFail($id);

		return View::make('documents.show', compact('document'));
	}

	/**
	 * Show the form for editing the specified document.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$document = Document::find($id);
        $units = Unit::orderBy('unit_type')->lists('name','id');

        $unitList = array();
        $unitList = $document->units()->lists('unit_id');
        $document->unitList = $unitList;
        return View::make('documents.edit', compact('document','units'));
	}

	/**
	 * Update the specified document in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$document = Document::findOrFail($id);

        $data = Input::only('title','description','from_unit_id');

		$validator = Validator::make($data, Document::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        //Patch files

        //files upload
        $files = Input::file('files');
        //if we have new file
        if(isset($files)){

            $filesName = array();
            foreach($files as $file) {
                if(isset($file)){
                    // public/uploads
                    $file->name = uniqid()."_".$file->getClientOriginalName();
                    $filesName[] = $file->name;
                    $file->move('uploads/',$file->name);
                }
            }
            $currentFiles = json_decode($document->files);
            if($currentFiles!=null)
                $document->files  = json_encode(array_merge($currentFiles,$filesName));
            else {
                $document->files = json_encode($filesName);
            }

        }
        $document->fill($data);
		$document->save();

        //dump pivot table units to
        $units = Input::get('to_units_id');
        $document->units()->detach();
        if (count($units)){
            $document->units()->attach($units);
        }

		return Redirect::route('documents.index');
	}

	/**
	 * Remove the specified document from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Document::destroy($id);

		return Redirect::route('documents.index');
	}

}
