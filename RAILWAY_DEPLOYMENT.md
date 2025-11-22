# 🚀 Railway Deployment Guide - AI Soul Mirror

## Prerequisites
- ✅ Railway Account ([railway.app](https://railway.app))
- ✅ GitHub Account
- ✅ Gemini API Key

---

## 📋 Step-by-Step Deployment

### **1. Push Code to GitHub**

```bash
# Initialize Git (if not already done)
git init
git add .
git commit -m "Ready for Railway deployment"

# Create GitHub repo and push
git remote add origin https://github.com/YOUR_USERNAME/ai-soul-mirror.git
git branch -M main
git push -u origin main
```

---

### **2. Create Railway Project**

1. Go to [railway.app](https://railway.app)
2. Click **"New Project"**
3. Select **"Deploy from GitHub repo"**
4. Choose your `ai-soul-mirror` repository
5. Railway will auto-detect Laravel

---

### **3. Add MySQL Database**

1. In your Railway project, click **"+ New"**
2. Select **"Database" → "Add MySQL"**
3. Railway will automatically create connection variables

---

### **4. Configure Environment Variables**

Click on your Laravel service → **"Variables"** tab and add:

```env
APP_NAME=AI Soul Mirror
APP_ENV=production
APP_DEBUG=false
APP_URL=https://YOUR_APP_URL.railway.app

# Database (Auto-filled by Railway)
MYSQLHOST=(Already set)
MYSQLPORT=(Already set)
MYSQLDATABASE=(Already set)
MYSQLUSER=(Already set)
MYSQLPASSWORD=(Already set)

# Your Gemini API Key
GEMINI_API_KEY=YOUR_ACTUAL_GEMINI_API_KEY_HERE
```

**Important:** 
- `APP_KEY` will be auto-generated
- `APP_URL` replace with your actual Railway URL

---

### **5. Deploy!**

Railway will automatically:
1. Build your Laravel app
2. Run migrations
3. Start the server

**First deployment takes ~5-10 minutes**

---

### **6. Run Database Seeder**

After first deployment, open Railway **"Console"** and run:

```bash
php artisan db:seed --class=GameSeeder
```

This will populate your 15 questions.

---

### **7. Get Your URL**

1. Go to your Laravel service
2. Click **"Settings"** → **"Networking"**
3. Click **"Generate Domain"**
4. Copy your URL: `https://your-app-name.up.railway.app`

---

## ✅ Post-Deployment Checklist

- [ ] Visit your URL and verify landing page loads
- [ ] Play through the game (all 15 questions)
- [ ] Check AI analysis works
- [ ] Test error handling (try refresh on loading screen)
- [ ] Add your URL to Google Analytics

---

## 🐛 Troubleshooting

### **"500 Internal Server Error"**
- Check Railway logs for errors
- Verify `APP_KEY` is set
- Verify `GEMINI_API_KEY` is correct

### **"Database connection failed"**
- Ensure MySQL service is running
- Check Database variables are set correctly

### **"AI Analysis Fails"**
- Verify `GEMINI_API_KEY` is valid
- Check Railway logs for API errors

---

## 💰 Cost Estimation (Free Tier)

- **Railway:** $5 credit/month (enough for ~500-1000 players)
- **MySQL:** Included in Railway credit
- **Gemini API:** Free Tier = ~10-20 players/day

---

## 🎉 You're Live!

Your game is now deployed and accessible worldwide.

**Next Steps:**
1. Share the URL with friends
2. Set up Google Analytics (now you have a real URL!)
3. Monitor Railway usage dashboard

Need help? Check Railway docs or let me know!
