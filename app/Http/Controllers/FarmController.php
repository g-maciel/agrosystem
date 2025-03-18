<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\LaborCost;
use App\Models\CapexItem;
use App\Models\FertilizerItem;
use App\Models\CropYield;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Employee;
use App\Models\KmlFile;
use App\Models\EmployeeRole;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    public function index()
    {
        return view('input');
    }

    public function store(Request $request)
    {
        //$request->validate(['kml_file' => 'required|file|mimes:kml']);
    
        
            $path = $request->file('kml_file')->store('kml_files', 'public');
            KmlFile::create(['file_name' => $request->file('kml_file')->hashName()]);
            
            return redirect()->route('fazenda')->with('success', 'Arquivo carregado com sucesso.');
    }

    public function dashboard()
    {

        // Dummy monthly data (replace with actual database queries)
        $months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun']; // Example months
        $totalExpenses = [5000, 4500, 5200, 4800, 5100, 4900]; // Dummy total expenses
        $earnings = [6000, 5500, 5800, 6200, 5900, 6100]; // Dummy revenue
        $employees = Employee::all()->count();

        $categories = ExpenseCategory::all();
        $categoryExpenses = [];
        foreach ($categories as $category) {
            // Dummy data per category; replace with real query like:
            // Expense::where('category_id', $category->id)->selectRaw('MONTH(payment_date) as month, SUM(amount) as total')->groupBy('month')->get()
            $categoryExpenses[$category->id] = [rand(1000,5000), rand(1000,5000), rand(1000,5000), rand(1000,5000), rand(1000,5000), rand(1000,5000)];
        }

        return view('dashboard', compact('months', 'totalExpenses', 'earnings', 'employees','categories', 'categoryExpenses'));
    }

    public function despesas()
    {
        $categories = ExpenseCategory::all();
        $employees = Employee::all();
        $expenses = Expense::with(['category', 'employee'])->orderBy('created_at', 'desc')->take(10)->get();
        return view('despesas', compact('categories', 'employees', 'expenses'));
    }

    public function addExpense(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric|min:0',
            'employee_id' => 'required|exists:employees,id',
            'payment_date' => 'required|date',
            'receipt' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('receipts', 'public');
            $validated['receipt'] = $path;
        }

        Expense::create($validated);
        return redirect()->route('despesas')->with('success', 'Despesa adicionada com sucesso.');
    }

    public function addCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ExpenseCategory::create($validated);
        return redirect()->route('despesas')->with('success', 'Categoria adicionada com sucesso.');
    }

    public function contratados()
    {
        $employees = Employee::with('role')->get();
        $roles = EmployeeRole::all();
        return view('contratados', compact('employees', 'roles'));
    }

    public function addEmployee(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'daily_hours' => 'required|numeric|min:0|max:24',
            'hourly_cost' => 'required|numeric|min:0',
            'role_id' => 'required|exists:employee_roles,id',
        ]);

        Employee::create($validated);
        return redirect()->route('contratados')->with('success', 'Empregado adicionado com sucesso.');
    }

    public function fazenda()
    {
        $farm = Farm::find(1);
        $kmlFiles = KmlFile::all();
        return view('fazenda', compact('farm', 'kmlFiles'));
    }
}