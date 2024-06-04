<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class fashionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/fashion";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];
        return view('fashion.index',compact('data'));
        
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/fashion";
        $response = $client->request('POST', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];
        return view('fashion.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fashion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomortelp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'text' => 'required|string',
        ]);
    
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imagePath = $image->store('images', 'public');
            $validatedData['gambar'] = $imagePath;
        }
    
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/fashion";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($validatedData)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
    
        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('fashion')->withErrors($error)->withInput();
        } else {
            return redirect()->to('fashion')->with('success', 'Berhasil memasukkan data');
        }
    }
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/fashion/$id";
        try {
            $response = $client->request('GET', $url);
            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);
            if ($contentArray['status'] != true) {
                $error = $contentArray['massage']; // Check for correct key in the API response
                return redirect()->to('fashion')->withErrors($error);
            } else {
                $data = $contentArray['data'];
                return view('fashion.edit', compact('data')); // Return edit view with data
            }
        } catch (\Exception $e) {
            return redirect()->to('fashion')->withErrors('An unexpected error occurred');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $nama = $request->nama;
    $nomortelp = $request->nomortelp;
    $alamat = $request->alamat;
    $text = $request->text;

    // Handle image upload if a new image is provided
    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar')->store('images', 'public');
    } else {
        // Retain the old image if no new image is uploaded
        $gambar = $request->gambar_old;
    }

    $parameter = [
        'nama' => $nama,
        'nomortelp' => $nomortelp,
        'alamat' => $alamat,
        'gambar' => $gambar,
        'text' => $text
    ];

    $client = new Client();
    $url = "http://127.0.0.1:8000/api/fashion/$id";
    try {
        $response = $client->request('PUT', $url, [
            'headers' => ['content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('fashion')->withErrors($error)->withInput();
        } else {
            return redirect()->to('fashion')->with('success', 'Berhasil memperbarui data');
        }
    } catch (\Exception $e) {
        return redirect()->to('fashion')->withErrors('An unexpected error occurred: ' . $e->getMessage())->withInput();
    }
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/fashion/$id";
        try {
            $response = $client->request('DELETE', $url);
            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);
            if ($contentArray['status'] != true) {
                $error = $contentArray['massage']; // Fix typo from 'massage' to 'message' if API provides 'message'
                return redirect()->to('fashion')->withErrors($error)->withInput();
            } else {
                return redirect()->to('fashion')->with('success', 'Berhasil menghapus data');
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $contentArray = json_decode($responseBodyAsString, true);
            $error = isset($contentArray['massage']) ? $contentArray['massage'] : 'Unknown error'; // Fix typo from 'massage' to 'message' if API provides 'message'
            return redirect()->to('fashion')->withErrors($error);
        } catch (\Exception $e) {
            return redirect()->to('fashion')->withErrors('An unexpected error occurred');
        }
    }
    
}
