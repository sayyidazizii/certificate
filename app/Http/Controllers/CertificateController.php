<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Winner;
use App\Models\Certificate;
use App\Models\Participant;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CertificateController extends Controller
{
    /**
     * Menampilkan data Certificate dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::with('participant', 'winner')->paginate(10);
        $participants = Participant::paginate(10);
        $winners = Winner::all();

        return view('content.Certificate.index', compact('participants','certificates','winners'));
    }

    /**
     * Menyimpan data Certificate baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate the request data (certificate_date is no longer required)
            $request->validate([
                'participant_id' => 'required|exists:participants,id',
                'winner_id' => 'required|exists:winners,id',
            ]);

            // Create the new Certificate with the current date
            Certificate::create([
                'participant_id' => $request->participant_id,
                'winner_id' => $request->winner_id,
                'certificate_date' => Carbon::now(),  // Automatically set to current date
                'created_id' => auth()->id(),
            ]);

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create Certificate: ' . $e->getMessage(), ['request' => $request->all(), 'exception' => $e]);
            return response()->json(['success' => false]);
        }
    }


    /**
     * Menghapus Certificate.
     *
     * @param \App\Models\Certificate $certificate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Certificate $certificate)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the Certificate
            $certificate->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Certificate deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete Certificate. Please try again.');
        }

        return redirect()->route('certificate.index');
    }

    public function print($certificate_id){
        $data = Certificate::with(['participant', 'winner'])->findOrFail($certificate_id);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        $pdf::SetPrintHeader(false);
        $pdf::SetPrintFooter(false);

        // $pdf::SetMargins(5, 1, 5, 1); // put space of 10 on top
        // Set margins
        $pdf::SetMargins(0, 0, 0);
        $pdf::SetAutoPageBreak(false);

        // $pdf::setImageScale(PDF_IMAGE_SCALE_RATIO);

        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf::setLanguageArray($l);
        }

        $pdf::AddPage('L');

        $pdf::SetFont('helvetica', '', 10);
        $pdf::SetTextColor(255, 165, 0);

        // Get the dimensions of the A4 page in landscape
        $pageWidth = $pdf::getPageWidth();
        $pageHeight = $pdf::getPageHeight();

        // Set the image dimensions to match the page dimensions
        $imageWidth = $pageWidth;
        $imageHeight = $pageHeight;


        $image = 'images/sertifikat.png';
         // Display image on full page
         $pdf::Image($image, 0, 0, $imageWidth, $imageHeight, 'PNG', '', '', true, 150);
        //  $pdf::Image($image, 5, 5, 1000, 700, '', '', '', false, 1080, '', false, false, 0);

        $tbl = "
            <table width=\" 100% \" style=\"text-align: center; \">
                <tr>
                    <th style=\"font-size:10px; \"></th>
                </tr>
                <tr>
                    <th style=\"font-size:10px; \"></th>
                </tr>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <tr>
                    <th style=\"font-size:30px;font-weight: bold;\">".strtoupper($data->participant->participant_name)."</th>
                </tr>
                <br><br><br>
                <tr>
                    <th style=\"font-size:20px;font-weight: bold;\">".strtoupper($data->winner->winner_name)."</th>
                </tr>
            </table>

        ";
        $pdf::writeHTML($tbl, true, false, false, false, '');
        $tbl1 = "
        ";


        $pdf::writeHTML($tbl1, true, false, false, false, '');


        $filename = 'Nota_Penjualan.pdf';
        $pdf::Output($filename, 'I');

    }



}
