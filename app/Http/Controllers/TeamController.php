<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();

        $roleCounts = [
            'Project Manager' => TeamMember::where('peran', 'LIKE', '%Manager%')->orWhere('peran', 'LIKE', '%PM%')->count(),
            'System Analyst' => TeamMember::where('peran', 'LIKE', '%Analyst%')->orWhere('peran', 'LIKE', '%Analis%')->count(),
            'Developer' => TeamMember::where('peran', 'LIKE', '%Developer%')->orWhere('peran', 'LIKE', '%Programmer%')->count(),
            'Database Designer' => TeamMember::where('peran', 'LIKE', '%Database%')->orWhere('peran', 'LIKE', '%DB%')->count(),
            'Tester / QA' => TeamMember::where('peran', 'LIKE', '%Tester%')->orWhere('peran', 'LIKE', '%QA%')->count(),
            'Doc & Support' => TeamMember::where('peran', 'LIKE', '%Doc%')->orWhere('peran', 'LIKE', '%Support%')->count(),
        ];

        return view('team.index', compact('members', 'roleCounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'peran' => 'required|string|max:100',
            'email' => 'nullable|email|max:255',
            'tugas' => 'nullable|string',
            'github_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'urutan' => 'nullable|integer',
        ]);

        TeamMember::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'peran' => $request->peran,
            'email' => $request->email,
            'tugas' => $request->tugas,
            'github_url' => $request->github_url,
            'linkedin_url' => $request->linkedin_url,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('team.index')->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function update(Request $request, TeamMember $team)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'peran' => 'required|string|max:100',
            'email' => 'nullable|email|max:255',
            'tugas' => 'nullable|string',
            'github_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'urutan' => 'nullable|integer',
        ]);

        $team->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'peran' => $request->peran,
            'email' => $request->email,
            'tugas' => $request->tugas,
            'github_url' => $request->github_url,
            'linkedin_url' => $request->linkedin_url,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('team.index')->with('success', 'Data anggota tim berhasil diperbarui!');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();

        return redirect()->route('team.index')->with('success', 'Anggota tim berhasil dihapus!');
    }
}
