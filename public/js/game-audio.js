class GameAudio {
    constructor() {
        this.ctx = null;
        this.masterGain = null;
        this.isMuted = localStorage.getItem('game_muted') === 'true';
        this.initialized = false;

        // Bind methods
        this.unlockAudio = this.unlockAudio.bind(this);
    }

    init() {
        if (this.initialized) return;

        try {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            this.ctx = new AudioContext();
            this.masterGain = this.ctx.createGain();
            this.masterGain.gain.value = this.isMuted ? 0 : 0.4;
            this.masterGain.connect(this.ctx.destination);

            // Start background ambience audio
            this.startBackgroundAudio();

            this.initialized = true;
            this.updateMuteUI();
            console.log("Audio Initialized. State:", this.ctx.state);

            // Add listeners to unlock audio if suspended (Autoplay Policy)
            if (this.ctx.state === 'suspended') {
                this.addUnlockListeners();
            }

        } catch (e) {
            console.error("Web Audio API not supported", e);
        }
    }

    addUnlockListeners() {
        ['click', 'touchstart', 'keydown'].forEach(event => {
            document.addEventListener(event, this.unlockAudio, { once: true });
        });
    }

    unlockAudio() {
        if (this.ctx && this.ctx.state === 'suspended') {
            this.ctx.resume().then(() => {
                console.log("Audio Context Resumed");
                // Remove listeners once resumed
                ['click', 'touchstart', 'keydown'].forEach(event => {
                    document.removeEventListener(event, this.unlockAudio);
                });
            });
        }
    }

    toggleMute() {
        this.isMuted = !this.isMuted;
        localStorage.setItem('game_muted', this.isMuted);

        if (this.masterGain) {
            this.masterGain.gain.setTargetAtTime(this.isMuted ? 0 : 0.4, this.ctx.currentTime, 0.1);
        }

        // Control background audio volume
        if (this.backgroundAudio) {
            this.backgroundAudio.volume = this.isMuted ? 0 : 0.6;
        }

        this.updateMuteUI();
        return this.isMuted;
    }

    updateMuteUI() {
        const btn = document.getElementById('mute-btn');
        if (btn) {
            btn.innerText = this.isMuted ? "🔇 Unmute Audio" : "🔊 Mute Audio";
            btn.classList.toggle('text-red-500', this.isMuted);
            btn.classList.toggle('text-green-500', !this.isMuted);
        }
    }

    startBackgroundAudio() {
        // Load and play background audio file
        const audio = new Audio('/audio/creeping-dark-ambience.mp3');
        audio.loop = true;
        audio.volume = this.isMuted ? 0 : 0.3;

        // Store reference for mute toggle
        this.backgroundAudio = audio;

        // Play with error handling
        audio.play().catch(err => {
            console.log('Background audio autoplay prevented:', err);
            // Will be played on first user interaction
            document.addEventListener('click', () => {
                audio.play().catch(e => console.log('Audio play failed:', e));
            }, { once: true });
        });
    }

    // --- Procedural Sounds ---

    startAmbience() {
        if (!this.ctx) return;

        // Dark Drone: Softer, more harmonious sound
        const osc1 = this.ctx.createOscillator();
        const osc2 = this.ctx.createOscillator();
        const gain = this.ctx.createGain();

        // Use Sine waves for a smoother, less harsh sound
        osc1.type = 'sine';
        osc2.type = 'sine';

        // Harmonious Interval (Perfect 5th) instead of dissonance
        // A2 (110Hz) and E3 (164.81Hz)
        osc1.frequency.value = 110;
        osc2.frequency.value = 164.81;

        // LFO for volume modulation (breathing effect)
        const lfo = this.ctx.createOscillator();
        lfo.frequency.value = 0.05; // Even slower breathing
        const lfoGain = this.ctx.createGain();
        lfoGain.gain.value = 0.1;

        lfo.connect(lfoGain);
        lfoGain.connect(gain.gain);

        osc1.connect(gain);
        osc2.connect(gain);
        gain.connect(this.masterGain);

        // Lower overall volume significantly
        gain.gain.value = 0.15;

        osc1.start();
        osc2.start();
        lfo.start();
    }

    playHover() {
        if (!this.ctx) return;
        if (this.ctx.state === 'suspended') this.ctx.resume();
        if (this.isMuted) return;

        // High pitch blip / static
        const osc = this.ctx.createOscillator();
        const gain = this.ctx.createGain();

        osc.type = 'sine';
        osc.frequency.setValueAtTime(800, this.ctx.currentTime);
        osc.frequency.exponentialRampToValueAtTime(1200, this.ctx.currentTime + 0.05);

        gain.gain.setValueAtTime(0.05, this.ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, this.ctx.currentTime + 0.05);

        osc.connect(gain);
        gain.connect(this.masterGain);

        osc.start();
        osc.stop(this.ctx.currentTime + 0.05);
    }

    playClick() {
        if (!this.ctx) return;
        if (this.ctx.state === 'suspended') this.ctx.resume();
        if (this.isMuted) return;

        // Heavy Thud
        const osc = this.ctx.createOscillator();
        const gain = this.ctx.createGain();

        osc.type = 'triangle';
        osc.frequency.setValueAtTime(100, this.ctx.currentTime);
        osc.frequency.exponentialRampToValueAtTime(0.01, this.ctx.currentTime + 0.3);

        gain.gain.setValueAtTime(0.3, this.ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, this.ctx.currentTime + 0.3);

        osc.connect(gain);
        gain.connect(this.masterGain);

        osc.start();
        osc.stop(this.ctx.currentTime + 0.3);
    }

    playReveal() {
        if (!this.ctx) return;
        if (this.ctx.state === 'suspended') this.ctx.resume();
        if (this.isMuted) return;

        // Ethereal Chord
        const freqs = [261.63, 329.63, 392.00, 523.25]; // C Major
        freqs.forEach((f, i) => {
            const osc = this.ctx.createOscillator();
            const gain = this.ctx.createGain();

            osc.type = 'sine';
            osc.frequency.value = f;

            gain.gain.setValueAtTime(0, this.ctx.currentTime);
            gain.gain.linearRampToValueAtTime(0.1, this.ctx.currentTime + 0.5 + (i * 0.1));
            gain.gain.exponentialRampToValueAtTime(0.001, this.ctx.currentTime + 4);

            osc.connect(gain);
            gain.connect(this.masterGain);

            osc.start();
            osc.stop(this.ctx.currentTime + 4);
        });
    }
}

// Global Instance
window.gameAudio = new GameAudio();
