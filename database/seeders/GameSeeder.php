<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Choice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        // ลบข้อมูลเก่าออก (ใช้ delete แทน truncate เพื่อรองรับ PostgreSQL)
        Choice::query()->delete();
        Question::query()->delete();

        // ==========================================
        // PHASE 1: การตื่นรู้และการเอาตัวรอด (Survival)
        // ==========================================

        // ข้อ 1: จุดเริ่มต้น
        $q1 = Question::create([
            'title' => 'The Awakening',
            'scenario' => 'คุณลืมตาตื่นขึ้นท่ามกลางความมืดมิดไร้ก้นบึ้ง มีเพียงเสียงลมหายใจแผ่วเบาที่รดต้นคอคุณจากด้านหลัง... สัญชาตญาณแรกของคุณคือ?',
            'image_path' => 'https://images.unsplash.com/photo-1509248961158-e54f6934749c?auto=format&fit=crop&w=800&q=80',
            'order' => 1
        ]);
        $q1->choices()->createMany([
            ['text' => 'เหวี่ยงหมัดหรืออาวุธออกไปด้านหลังทันที!', 'trait' => 'Power (สัญชาตญาณนักรบ)'],
            ['text' => 'กลิ้งตัวหลบไปด้านข้างและซ่อนตัวในเงามืด', 'trait' => 'Cunning (สัญชาตญาณนักฆ่า)'],
            ['text' => 'อยู่นิ่งๆ และพยายามจับทิศทางเสียงเพื่อวิเคราะห์', 'trait' => 'Wisdom (ความสุขุม)'],
            ['text' => 'เอ่ยถามออกไปว่า "นั่นใคร? ต้องการความช่วยเหลือไหม?"', 'trait' => 'Empathy (ความเมตตา)'],
        ]);

        // ข้อ 2: สะพานกระดูก
        $q2 = Question::create([
            'title' => 'The Bridge of Bones',
            'scenario' => 'ทางไปต่อคือสะพานที่สร้างจากโครงกระดูกมนุษย์ มันดูเปราะบางและพร้อมจะพังทลาย ใต้สะพานคือบ่อลาวาสีดำ',
            'image_path' => 'https://images.unsplash.com/photo-1618557219623-855c596d4790?auto=format&fit=crop&w=800&q=80',
            'order' => 2
        ]);
        $q2->choices()->createMany([
            ['text' => 'วิ่งฝ่าไปให้เร็วที่สุด ก่อนที่มันจะพัง', 'trait' => 'Power (ความกล้าบ้าบิ่น)'],
            ['text' => 'ค่อยๆ คลานไปตามคานกระดูกที่ดูแข็งแรงที่สุด', 'trait' => 'Cunning (ความรอบคอบ)'],
            ['text' => 'ร่ายเวทย์หรือหาวิธีเสริมความแข็งแกร่งให้สะพานก่อน', 'trait' => 'Wisdom (การแก้ปัญหา)'],
            ['text' => 'มองหาทางอ้อมอื่น แม้จะไกลกว่าแต่ปลอดภัยกว่า', 'trait' => 'Empathy (รักตัวกลัวตาย/ระวังตัว)'],
        ]);

        // ข้อ 3: หมาป่าสามหัว
        $q3 = Question::create([
            'title' => 'Guardian of the Gate',
            'scenario' => 'หมาป่าสามหัวร่างยักษ์ขวางประตูอยู่ หัวซ้ายหลับ หัวขวากำลังแทะกระดูก ส่วนหัวกลางจ้องมองคุณด้วยแววตาที่เจ็บปวด เพราะมีดาบปักคาอยู่',
            'image_path' => 'https://images.unsplash.com/photo-1550757750-4ce187a65014?auto=format&fit=crop&w=800&q=80',
            'order' => 3
        ]);
        $q3->choices()->createMany([
            ['text' => 'ฉวยโอกาสโจมตีจุดตายขณะที่มันบาดเจ็บ', 'trait' => 'Power (ความเด็ดขาด)'],
            ['text' => 'ลอบผ่านไปทางด้านหัวที่หลับอยู่เงียบๆ', 'trait' => 'Cunning (การลอบเร้น)'],
            ['text' => 'สังเกตดาบเล่มนั้น... มันอาจเป็นอาวุธวิเศษ', 'trait' => 'Wisdom (ช่างสังเกต/ความโลภในความรู้)'],
            ['text' => 'เสี่ยงชีวิตเข้าไปดึงดาบออกเพื่อช่วยมัน', 'trait' => 'Empathy (ผู้รักษา/เสียสละ)'],
        ]);

        // ==========================================
        // PHASE 2: ศีลธรรมและเล่ห์เหลี่ยม (Morality)
        // ==========================================

        // ข้อ 4: ตลาดวิญญาณ
        $q4 = Question::create([
            'title' => 'The Phantom Market',
            'scenario' => 'คุณพบตลาดผีสิง พ่อค้าไร้หน้าคนหนึ่งยื่น "ขวดแก้วบรรจุความทรงจำที่หายไปของคุณ" ให้ แลกกับ "นิ้วมือข้างหนึ่ง" ของคุณ',
            'image_path' => 'https://images.unsplash.com/photo-1513569771920-c9e1d31714b0?auto=format&fit=crop&w=800&q=80',
            'order' => 4
        ]);
        $q4->choices()->createMany([
            ['text' => 'ขู่บังคับให้เขาส่งขวดมา ถ้าไม่อยากเจ็บตัว', 'trait' => 'Power (ข่มขู่/ใช้อำนาจ)'],
            ['text' => 'ใช้มายากลหลอกสลับขวดแก้วมาโดยไม่เสียอะไรเลย', 'trait' => 'Cunning (จอมโจร)'],
            ['text' => 'ปฏิเสธข้อเสนอ อดีตไม่สำคัญเท่าปัจจุบัน', 'trait' => 'Wisdom (การปล่อยวาง)'],
            ['text' => 'ยอมแลก... ความทรงจำคือสิ่งล้ำค่าที่สุด', 'trait' => 'Empathy (ยึดติดอารมณ์)'],
        ]);

        // ข้อ 5: กระจกสะท้อนกรรม
        $q5 = Question::create([
            'title' => 'Mirror of Sins',
            'scenario' => 'คุณเดินผ่านห้องกระจกเงา แต่เงาในกระจกไม่ได้ทำตามคุณ มันกำลังแสยะยิ้มและหยิบมีดขึ้นมาจ่อคอตัวเอง',
            'image_path' => 'https://images.unsplash.com/photo-1519501025264-65ba15a82390?auto=format&fit=crop&w=800&q=80',
            'order' => 5
        ]);
        $q5->choices()->createMany([
            ['text' => 'ทุบกระจกให้แตกละเอียดทันที!', 'trait' => 'Power (ทำลายล้าง)'],
            ['text' => 'จ้องตากลับไปอย่างไม่เกรงกลัว เพื่อข่มขวัญมัน', 'trait' => 'Cunning (จิตวิทยา)'],
            ['text' => 'ถามมันว่า "เจ้าต้องการสื่อสารอะไร?"', 'trait' => 'Wisdom (ความอยากรู้อยากเห็น)'],
            ['text' => 'ร้องไห้และขอร้องให้มันหยุดทำร้ายตัวเอง', 'trait' => 'Empathy (ความอ่อนไหว)'],
        ]);

        // ข้อ 6: นักโทษในกรงขัง
        $q6 = Question::create([
            'title' => 'The Caged Spirit',
            'scenario' => 'คุณพบวิญญาณเด็กสาวถูกขังในกรงเวทย์มนตร์ เธอบอกว่าถ้าคุณปล่อยเธอ เธอจะมอบแผนที่ทางออกให้ แต่กรงนี้ต้องใช้ "เลือดของผู้ปลดปล่อย" ในการเปิด',
            'image_path' => 'https://images.unsplash.com/photo-1555662092-339331b98895?auto=format&fit=crop&w=800&q=80',
            'order' => 6
        ]);
        $q6->choices()->createMany([
            ['text' => 'พังลูกกรงด้วยพละกำลัง แม้ตัวเองจะบาดเจ็บ', 'trait' => 'Power (เสียสละด้วยกำลัง)'],
            ['text' => 'หลอกล่อให้สัตว์แถวนั้นมาแตะกรงแทน', 'trait' => 'Cunning (เจ้าเล่ห์เพทุบาย)'],
            ['text' => 'ตรวจสอบวงเวทย์ที่กรง เพื่อหาวิธีปลดล็อกอื่น', 'trait' => 'Wisdom (นักปราชญ์)'],
            ['text' => 'กรีดเลือดตัวเองทันทีเพื่อช่วยเธอ', 'trait' => 'Empathy (วีรบุรุษ)'],
        ]);

        // ==========================================
        // PHASE 3: ความรู้และอำนาจ (Power & Knowledge)
        // ==========================================

        // ข้อ 7: หอสมุดต้องห้าม
        $q7 = Question::create([
            'title' => 'Library of Forbidden Lore',
            'scenario' => 'หนังสือเล่มหนึ่งลอยลงมาตรงหน้าคุณ หน้าปกเขียนว่า "ความจริงของจักรวาลที่จะทำให้ผู้ที่รู้อาจเป็นบ้าได้"',
            'image_path' => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=800&q=80',
            'order' => 7
        ]);
        $q7->choices()->createMany([
            ['text' => 'เผามันทิ้งซะ! ความรู้แบบนี้อันตรายเกินไป', 'trait' => 'Power (ผู้คุมกฎ/เคร่งครัด)'],
            ['text' => 'แอบฉีกหน้าสำคัญเก็บไว้ แล้วทิ้งเล่มปลอมไว้แทน', 'trait' => 'Cunning (ฉกฉวยโอกาส)'],
            ['text' => 'เปิดอ่านทุกหน้า ข้าพร้อมแลกสติกับความจริง', 'trait' => 'Wisdom (กระหายความรู้)'],
            ['text' => 'เก็บไว้อย่างดี เพื่อป้องกันไม่ให้ใครมาเปิดอ่าน', 'trait' => 'Empathy (ผู้ปกป้อง)'],
        ]);

        // ข้อ 8: บัลลังก์ว่างเปล่า
        $q8 = Question::create([
            'title' => 'The Empty Throne',
            'scenario' => 'กลางห้องโถงใหญ่ มีบัลลังก์ทองคำตั้งอยู่ จารึกบอกว่า "ผู้ที่นั่งจะได้รับอำนาจปกครองมิตินี้ แต่ต้องแลกด้วยการโดดเดี่ยวตลอดกาล"',
            'image_path' => 'https://images.unsplash.com/photo-1598556776374-0a37466d3543?auto=format&fit=crop&w=800&q=80',
            'order' => 8
        ]);
        $q8->choices()->createMany([
            ['text' => 'ขึ้นนั่งทันที ข้าเกิดมาเพื่อเป็นราชา', 'trait' => 'Power (ทะเยอทะยาน/ผู้นำ)'],
            ['text' => 'ตรวจสอบบัลลังก์หาอัญมณี แล้วงัดแงะเอาไปขาย', 'trait' => 'Cunning (โลภ/ฉลาดแกมโกง)'],
            ['text' => 'ศึกษากลไกของมัน อำนาจที่มาง่ายๆ มักมีกับดัก', 'trait' => 'Wisdom (ระแวงสงสัย)'],
            ['text' => 'เดินผ่านไป อำนาจไม่มีความหมายหากไร้คนเคียงข้าง', 'trait' => 'Empathy (ให้ค่าความสัมพันธ์)'],
        ]);

        // ข้อ 9: ดาบในหิน (เวอร์ชั่นมืด)
        $q9 = Question::create([
            'title' => 'The Cursed Blade',
            'scenario' => 'ดาบสีดำสนิทปักอยู่บนแท่นหิน มันแผ่รังสีความชั่วร้ายรุนแรง แต่มันกระซิบว่า "ข้าจะมอบพลังให้เจ้าสังหารศัตรูได้ทุกคน"',
            'image_path' => 'https://images.unsplash.com/photo-1589923158776-cb4485d99fd6?auto=format&fit=crop&w=800&q=80',
            'order' => 9
        ]);
        $q9->choices()->createMany([
            ['text' => 'ดึงดาบออกมา! พลังคือความถูกต้อง', 'trait' => 'Power (บ้าพลัง/Dark Knight)'],
            ['text' => 'ไม่แตะต้อง แต่ล่อศัตรูเข้ามาในระยะของดาบให้มันจัดการ', 'trait' => 'Cunning (ยืมมือฆ่าคน)'],
            ['text' => 'ร่ายเวทย์ผนึกดาบนี้ไว้ชั่วกัลปาวสาน', 'trait' => 'Wisdom (ผู้ผนึกมาร)'],
            ['text' => 'สวดภาวนาให้วิญญาณในดาบไปสู่สุขคติ', 'trait' => 'Empathy (นักบวช)'],
        ]);

        // ==========================================
        // PHASE 4: บททดสอบสุดท้าย (The Final Test)
        // ==========================================

        // ข้อ 10: ทางแยกแห่งชะตา
        $q10 = Question::create([
            'title' => 'The Crossroads of Fate',
            'scenario' => 'ทางแยก 4 สายปรากฏขึ้นเบื้องหน้า แต่ละสายนำไปสู่จุดจบที่ต่างกัน',
            'image_path' => 'https://images.unsplash.com/photo-1478147427282-58a87a120781?auto=format&fit=crop&w=800&q=80',
            'order' => 10
        ]);
        $q10->choices()->createMany([
            ['text' => 'ทางที่เต็มไปด้วยเปลวเพลิงและการต่อสู้', 'trait' => 'Power (Warrior Path)'],
            ['text' => 'ทางที่มืดมิดและเงียบสงัด', 'trait' => 'Cunning (Assassin Path)'],
            ['text' => 'ทางที่ปูด้วยแผ่นศิลาจารึกความรู้', 'trait' => 'Wisdom (Mage Path)'],
            ['text' => 'ทางที่มีแสงสว่างและเสียงดนตรี', 'trait' => 'Empathy (Healer Path)'],
        ]);

        // ข้อ 11: การเสียสละ
        $q11 = Question::create([
            'title' => 'The Ultimate Sacrifice',
            'scenario' => 'ประตูทางออกอยู่ตรงหน้า แต่ต้องทิ้งสิ่งสำคัญที่สุดไว้หนึ่งอย่างเพื่อผ่านไป',
            'image_path' => 'https://images.unsplash.com/photo-1506702315536-dd8b83e2dcf9?auto=format&fit=crop&w=800&q=80',
            'order' => 11
        ]);
        $q11->choices()->createMany([
            ['text' => 'ทิ้ง "พละกำลัง" (ยอมร่างกายอ่อนแอ)', 'trait' => 'Wisdom (เห็นค่าจิตใจมากกว่ากาย)'],
            ['text' => 'ทิ้ง "ศักดิ์ศรี" (ยอมคลานลอดหว่างขา)', 'trait' => 'Cunning (เป้าหมายสำคัญสุด)'],
            ['text' => 'ทิ้ง "ความทรงจำ" (ลืมตัวตน)', 'trait' => 'Empathy (ยอมเริ่มใหม่)'],
            ['text' => 'ไม่ยอมทิ้งอะไรเลย! ข้าจะพังประตูนี้ด้วยมือเปล่า', 'trait' => 'Power (ดื้อรั้น/ไม่ยอมแพ้)'],
        ]);

        // ข้อ 12: ปีศาจในใจ
        $q12 = Question::create([
            'title' => 'The Shadow Self',
            'scenario' => 'เงาของคุณลุกขึ้นยืนและพูดว่า "ข้าคือความชั่วร้ายในใจเจ้า ข้าจะยึดร่างเจ้าเดี๋ยวนี้"',
            'image_path' => 'https://images.unsplash.com/photo-1508108712903-49b7efd9c36d?auto=format&fit=crop&w=800&q=80',
            'order' => 12
        ]);
        $q12->choices()->createMany([
            ['text' => 'ต่อสู้กับมันจนตัวตาย', 'trait' => 'Power (นักสู้)'],
            ['text' => 'หลอกล่อให้มันติดกับดักในจิตใจ', 'trait' => 'Cunning (นักวางแผน)'],
            ['text' => 'ยอมรับมัน "เจ้าก็คือข้า เรามารวมกันเถอะ"', 'trait' => 'Wisdom (ความเข้าใจตนเอง)'],
            ['text' => 'ให้อภัยมัน และกอดมันด้วยความรัก', 'trait' => 'Empathy (เมตตาธรรม)'],
        ]);

        // ข้อ 13: เสียงเรียกจากความมืด
        $q13 = Question::create([
            'title' => 'Call of the Void',
            'scenario' => 'ความมืดรอบตัวเริ่มบีบอัดเข้ามา เสียงกระซิบเร่งเร้าให้คุณยอมแพ้และหลับใหลไปตลอดกาล',
            'image_path' => 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?auto=format&fit=crop&w=800&q=80',
            'order' => 13
        ]);
        $q13->choices()->createMany([
            ['text' => 'คำรามสุดเสียงเพื่อปลุกใจตนเอง', 'trait' => 'Power (จิตใจเข้มแข็ง)'],
            ['text' => 'หยิกตัวเองให้เจ็บเพื่อให้ตื่นตัว', 'trait' => 'Cunning (วิธีการเอาตัวรอด)'],
            ['text' => 'ทำสมาธิและกำหนดลมหายใจ', 'trait' => 'Wisdom (ความสงบ)'],
            ['text' => 'นึกถึงหน้าคนที่รักเพื่อเป็นกำลังใจ', 'trait' => 'Empathy (พลังแห่งรัก)'],
        ]);

        // ข้อ 14: รางวัลของผู้ชนะ
        $q14 = Question::create([
            'title' => 'The Reward',
            'scenario' => 'เทพธิดาปรากฏกายและมอบพรให้หนึ่งข้อ คุณจะขออะไร?',
            'image_path' => 'https://images.unsplash.com/photo-1500043357865-c6b8827710a6?auto=format&fit=crop&w=800&q=80',
            'order' => 14
        ]);
        $q14->choices()->createMany([
            ['text' => 'ขอเป็นผู้ที่แข็งแกร่งที่สุดในปถพี', 'trait' => 'Power (อำนาจนิยม)'],
            ['text' => 'ขอความสามารถในการล่องหนและอ่านใจคน', 'trait' => 'Cunning (ความได้เปรียบ)'],
            ['text' => 'ขอรู้ความลับทุกอย่างในจักรวาล', 'trait' => 'Wisdom (ปัญญาญาณ)'],
            ['text' => 'ขอให้โลกนี้สงบสุขตลอดไป', 'trait' => 'Empathy (อุดมคติ)'],
        ]);

        // ข้อ 15: บทสรุป (The End)
        $q15 = Question::create([
            'title' => 'Reincarnation',
            'scenario' => 'การเดินทางสิ้นสุดลง... วิญญาณของคุณกำลังจะจุติใหม่ แสงสว่างวาบขึ้น... คุณปรารถนาจะเป็นสิ่งใด?',
            'image_path' => 'https://images.unsplash.com/photo-1470252649378-9c29740c9fa8?auto=format&fit=crop&w=800&q=80',
            'order' => 15
        ]);
        $q15->choices()->createMany([
            ['text' => 'มังกรผู้ยิ่งใหญ่ (The Dragon)', 'trait' => 'Power (Highborn/Ruler)'],
            ['text' => 'จิ้งจอกเก้าหาง (The Nine-Tailed Fox)', 'trait' => 'Cunning (Mystic/Trickster)'],
            ['text' => 'นกฮูกผู้เฝ้าหอคอย (The Owl)', 'trait' => 'Wisdom (Observer/Sage)'],
            ['text' => 'ยูนิคอร์นผู้บริสุทธิ์ (The Unicorn)', 'trait' => 'Empathy (Healer/Pure Soul)'],
        ]);
    }
}
    }
}