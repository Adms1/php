<?php

namespace App\Http\Controllers\V1\Backend;

// use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\LanguageCreateRequest;
use App\Http\Requests\LanguageUpdateRequest;
use App\Repositories\LanguageRepository;
use App\Validators\LanguageValidator;
//use App\Http\Requests;

/**
 * Class LanguagesController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class LanguagesController extends Controller
{
    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * @var LanguageValidator
     */
    protected $validator;

    /**
     * LanguagesController constructor.
     *
     * @param LanguageRepository $languageRepository
     * @param LanguageValidator $validator
     */
    public function __construct(LanguageRepository $languageRepository, LanguageValidator $validator)
    {
        $this->languageRepository = $languageRepository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->languageRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $languages = $this->languageRepository->getLanguageList();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $languages,
            ]);
        }

        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languages.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LanguageCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Insert new language
            $language = $this->languageRepository->create($request->all());
            if ($language) {
                $response = [
                    'message' => 'Language successfully created.',
                    'status' => 'success',
                    'data'    => $language->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Language not created.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('language_list')->with('response', $response);
            
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = $this->languageRepository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $language,
            ]);
        }

        return view('admin.languages.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = $this->languageRepository->find($id);
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LanguageUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Update Language
            $language = $this->languageRepository->update($request->all(), $id);
            if ($language) {
                $response = [
                    'message' => 'Language successfully updated.',
                    'status' => 'success',
                    'data'    => $language->toArray(),
                ];
            } else {
                $response = [
                    'message' => 'Language not updated.',
                    'status' => 'danger',
                ];
            }
            return redirect()->route('language_list')->with('response', $response);
            
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->languageRepository->deleteLanguage($id);
        if ($deleted) {
            $response = [
                'message' => 'Language successfully deleted.',
                'status' => 'success',
            ];
        } else {
            $response = [
                'message' => 'Language not deleted.',
                'status' => 'danger',
            ];
        }

        return redirect()->back()->with('response', $response);
    }
}
