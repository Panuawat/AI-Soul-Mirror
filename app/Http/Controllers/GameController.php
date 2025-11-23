<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    // 1. เริ่มเกม (เข้าสู่ Intro)
    public function start()
    {
        Session::forget('game_answers'); // ล้างคำตอบเก่า
        return redirect()->route('game.intro');
    }

    // 1.5 หน้า Intro (เนื้อเรื่องก่อนเริ่ม)
    public function intro()
    {
        return view('game.intro');
    }

    // 1.8 เริ่มต้นคำถามข้อแรก (หลังจากอ่าน Intro จบ)
    public function begin()
    {
        // หาข้อแรก (เรียงตามลำดับ order น้อยสุด)
        $firstQuestion = Question::orderBy('order')->first();
        
        // ป้องกันกรณีไม่มีคำถามใน DB
        if (!$firstQuestion) {
            return "ยังไม่มีข้อมูลคำถามในระบบ กรุณารัน Seeder ก่อน (php artisan db:seed --class=GameSeeder)";
        }

        return redirect()->route('game.play', $firstQuestion->id);
    }

    // 2. หน้าเล่นเกม (แสดงคำถาม)
    public function play($id)
    {
        $question = Question::with('choices')->findOrFail($id);
        
        // คำนวณ Progress
        $totalQuestions = Question::count();
        // สมมติว่าเรียงตาม order, หาว่าข้อปัจจุบันคือลำดับที่เท่าไหร่
        $currentQuestionNumber = Question::where('order', '<=', $question->order)->count();

        // หาข้อถัดไปเพื่อ Preload รูปภาพ
        $nextQuestion = Question::where('order', '>', $question->order)
                                ->orderBy('order')
                                ->select('image_path')
                                ->first();
        $nextImage = $nextQuestion ? $nextQuestion->image_path : null;

        return view('game.play', compact('question', 'totalQuestions', 'currentQuestionNumber', 'nextImage'));
    }

    // 3. รับคำตอบและไปข้อต่อไป
    public function submit(Request $request, $id)
    {
        $choiceId = $request->input('choice_id');
        
        // บันทึกคำตอบลง Session
        $answers = Session::get('game_answers', []);
        $answers[$id] = $choiceId;
        Session::put('game_answers', $answers);

        // หาข้อต่อไป
        $currentQuestion = Question::find($id);
        $nextQuestion = Question::where('order', '>', $currentQuestion->order)
                                ->orderBy('order')
                                ->first();

        if ($nextQuestion) {
            return redirect()->route('game.play', $nextQuestion->id);
        } else {
            // ถ้าไม่มีข้อต่อแล้ว -> ไปหน้า Loading Screen ก่อนเข้าสู่ Ritual
            return redirect()->route('game.loading');
        }
    }

    // 3.5 หน้า Loading Screen (The Ritual)
    public function loading()
    {
        return view('game.loading');
    }

    // 4. ส่งข้อมูลให้ AI วิเคราะห์ (The Ritual)
    public function analyze()
    {
        $answers = Session::get('game_answers');
        if (!$answers) return redirect()->route('game.start');

        // รวบรวมข้อมูลการตัดสินใจของผู้เล่น
        $storyLog = "";
        foreach ($answers as $qId => $cId) {
            $q = Question::find($qId);
            $c = Choice::find($cId);
            if ($q && $c) {
                $storyLog .= "- สถานการณ์: \"{$q->title}\" ผู้เล่นเลือก: \"{$c->text}\" (Trait แฝง: {$c->trait})\n";
            }
        }

        // สร้าง Prompt
        $prompt = "
            Role: คุณคือ 'The Void Watcher' (ผู้เฝ้ามองจากความว่างเปล่า) ตัวตนโบราณที่มองเห็นแก่นแท้ของวิญญาณมนุษย์ผ่านการกระทำ
            Task: วิเคราะห์ 'เนื้อแท้ของวิญญาณ' (Soul Essence) ของผู้เล่นจากการตัดสินใจในสถานการณ์จำลอง
            
            History of Choices:
            {$storyLog}

            Style Guide (สำคัญมาก):
            - ใช้ภาษาที่ 'กาว' (Surreal), เป็นนามธรรม (Abstract), และมีความเป็นปรัชญา (Philosophical) สูง
            - เปรียบเปรยกับสิ่งที่ยิ่งใหญ่ เช่น ดวงดาว, ความมืด, จักรวาล, ความเงียบงัน, หรือกาลเวลา
            - ให้ความรู้สึกขลัง ลึกลับ เหมือนคำทำนายจากคัมภีร์โบราณ หรือเสียงกระซิบจากปีศาจ
            - **แต่** ต้องแฝงคำอธิบายที่เชื่อมโยงกับนิสัยจริง ๆ ของผู้เล่นด้วย (เช่น ถ้าเขาเลือกช่วยคน ให้เปรียบเป็นแสงสว่างที่โง่เขลาแต่กล้าหาญ) เพื่อให้ผู้เล่นเข้าใจว่าทำไมถึงได้ผลลัพธ์นี้

            โปรดตอบกลับมาในรูปแบบ JSON เท่านั้น โดยมีโครงสร้างดังนี้:
            {
                \"class_name\": \"ชื่อคลาสวิญญาณ (ภาษาอังกฤษที่ดูเท่และลึกลับ เช่น 'Weaver of Silence', 'Chaos Architect')\",
                \"title\": \"ฉายาภาษาไทยที่แปลกและกาว (เช่น 'ผู้ถักทอความเงียบงันแห่งรุ่งอรุณ', 'สถาปนิกแห่งความโกลาหล')\",
                \"description\": \"คำบรรยายวิญญาณ ความยาว 5-6 บรรทัด เขียนให้ลึกซึ้ง กินใจ และกาวสุดๆ ผสมผสานระหว่างการพรรณนาโวหารและการวิเคราะห์นิสัยที่ซ่อนอยู่\",
                \"stats\": {
                    \"strength\": (คะแนน 1-10: ความแข็งแกร่งของจิตใจ),
                    \"intelligence\": (คะแนน 1-10: การหยั่งรู้และความเข้าใจ),
                    \"empathy\": (คะแนน 1-10: ความเชื่อมโยงกับผู้อื่น),
                    \"darkness\": (คะแนน 1-10: ความลึกลับและด้านมืดในใจ)
                }
            }
            ตอบเป็น JSON เท่านั้น ไม่ต้องมีข้อความอื่นนำหน้าหรือต่อท้าย
        ";

        // Retry Logic: พยายามสูงสุด 3 ครั้ง
        $maxAttempts = 3;
        $attempt = 0;
        $apiKey = env('GEMINI_API_KEY');

        while ($attempt < $maxAttempts) {
            $attempt++;

            try {
                // ยิง Gemini API พร้อม timeout 30 วินาที
                $response = Http::timeout(30)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-09-2025:generateContent?key={$apiKey}", [
                        'contents' => [['parts' => [['text' => $prompt]]]],
                        'generationConfig' => ['responseMimeType' => 'application/json']
                    ]);

                // ตรวจสอบ HTTP Status Code
                if ($response->status() === 429) {
                    // Rate Limit - ถ้ายังลองได้อีก ให้รอแล้วลองใหม่
                    if ($attempt < $maxAttempts) {
                        sleep(2); // รอ 2 วินาทีแล้วลองใหม่
                        continue;
                    }
                    return redirect()->route('game.error', ['type' => 'rate_limit']);
                }

                if ($response->status() >= 500) {
                    // Server Error - ถ้ายังลองได้อีก ให้ลองใหม่
                    if ($attempt < $maxAttempts) {
                        sleep(1);
                        continue;
                    }
                    return redirect()->route('game.error', ['type' => 'server_error']);
                }

                if ($response->successful()) {
                    $resultText = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    
                    if (!$resultText) {
                        return redirect()->route('game.error', ['type' => 'json_error']);
                    }

                    $characterData = json_decode($resultText, true);
                    
                    // ป้องกันกรณี JSON แตก
                    if (!$characterData || !isset($characterData['class_name'])) {
                        return redirect()->route('game.error', ['type' => 'json_error']);
                    }

                    // สำเร็จ! แสดงผลลัพธ์
                    return view('game.result', compact('characterData'));
                } else {
                    // HTTP Error อื่นๆ
                    if ($attempt < $maxAttempts) {
                        sleep(1);
                        continue;
                    }
                    return redirect()->route('game.error', ['type' => 'server_error']);
                }

            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                // Timeout หรือ Connection Error
                if ($attempt < $maxAttempts) {
                    sleep(1);
                    continue;
                }
                return redirect()->route('game.error', ['type' => 'timeout']);
            } catch (\Exception $e) {
                // Error อื่นๆ ที่ไม่คาดคิด
                \Log::error('AI Analysis Error: ' . $e->getMessage());
                if ($attempt < $maxAttempts) {
                    sleep(1);
                    continue;
                }
                return redirect()->route('game.error', ['type' => 'unknown']);
            }
        }

        // ถ้าลองครบ 3 ครั้งแล้วยังไม่สำเร็จ
        return redirect()->route('game.error', ['type' => 'unknown']);
    }

    // 5. หน้า Error
    public function error()
    {
        return view('game.error');
    }
}