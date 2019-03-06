package com.example.dev_area_2018

import android.animation.Animator
import android.content.Intent
import android.os.Bundle
import android.os.CountDownTimer
import android.support.v4.content.ContextCompat
import android.support.v7.app.AppCompatActivity
import android.view.View
import android.view.View.VISIBLE
import android.view.Window
import android.view.WindowManager
import android.widget.EditText
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import kotlinx.android.synthetic.main.activity_main.*
import org.json.JSONObject
import org.w3c.dom.Text

class MainActivity : AppCompatActivity() {

    var token = ""
    lateinit var globalClass: GlobalClass

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        requestWindowFeature(Window.FEATURE_NO_TITLE)
        globalClass = applicationContext as GlobalClass
        window.setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
                WindowManager.LayoutParams.FLAG_FULLSCREEN)
        setContentView(R.layout.activity_main)
        object : CountDownTimer(1000, 1000) {
            override fun onFinish() {
                bookITextView.visibility = View.GONE
                loadingProgressBar.visibility = View.GONE
                rootView.setBackgroundColor(ContextCompat.getColor(this@MainActivity, R.color.colorSplashText))
                bookIconImageView.setImageResource(R.drawable.background_color_book)
                startAnimation()
            }

            override fun onTick(p0: Long) {}
        }.start()
    }

    private fun startAnimation() {
        bookIconImageView.animate().apply {
            x(50f)
            y(100f)
            duration = 1000
        }.setListener(object : Animator.AnimatorListener {
            override fun onAnimationRepeat(p0: Animator?) {

            }

            override fun onAnimationEnd(p0: Animator?) {
                afterAnimationView.visibility = VISIBLE
            }

            override fun onAnimationCancel(p0: Animator?) {

            }

            override fun onAnimationStart(p0: Animator?) {

            }
        })
    }

    fun onClickLogIn(v: View) {
        val login = findViewById<EditText>(R.id.emailEditText).text
        val pass = findViewById<EditText>(R.id.passwordEditText).text
        val apiLink = findViewById<EditText>(R.id.apilink).text.toString()
        if (apiLink.isNotEmpty())
            globalClass.apilink = apiLink
        val queue = Volley.newRequestQueue(this)
        val url = globalClass.apilink + "/user?login=$login&pass=$pass"
        val stringReq = StringRequest(
            Request.Method.GET, url,
            Response.Listener<String> { response ->
                var strResp = response.toString()
                try {
                    val obj = JSONObject(strResp)
                    token = obj.getString("token")
                    println("token: $token")
                } catch (e: Exception) {
                    println(e)
                }
                if (token.isNotEmpty()) {
                    val intent = Intent(this, SignServices::class.java)
                    startActivity(intent)
                }
            },
            Response.ErrorListener { println("[ERROR]: FAILED") })
        queue.add(stringReq)
    }

    fun onCLickRegisterActivity(v: View) {
        val intent = Intent(this, Register::class.java)
        startActivity(intent)
    }
}

