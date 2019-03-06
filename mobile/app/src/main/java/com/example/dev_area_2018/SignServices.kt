package com.example.dev_area_2018


import android.content.Intent
import android.net.Uri
import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.util.Log
import android.view.View
import android.widget.TextView
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import org.json.JSONException
import org.json.JSONObject

class SignServices : AppCompatActivity() {

    private val clientId = "e86bb13fe8090d566b98"
    private val clientSecret = "ba43721037725760d996f39b7eb7e55abdf97d42"
    private val redirectUri = "futurestudio://callback"

    private lateinit var globalclass : GlobalClass

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login_services)

        globalclass = applicationContext as GlobalClass
    }

    override fun onResume() {

        super.onResume()

        // the intent filter defined in AndroidManifest will handle the return from ACTION_VIEW intent
        val uri = intent.data
        if (uri != null && uri.toString().startsWith(redirectUri)) {
            when (globalclass.services) {
                "github" -> onResumeGitHub(uri)
                "imgur" -> onResumeImgur(uri)
            }
        }
    }

    fun onClickGitHub(v: View) {
        globalclass.services = "github"
        val intent = Intent(
            Intent.ACTION_VIEW,
            Uri.parse("https://github.com/login/oauth/authorize?client_id=$clientId&scope=repo&redirect_uri=$redirectUri")
        )
        startActivity(intent)
    }

    private fun onResumeGitHub(uri: Uri) {
        val code = uri.getQueryParameter("code")
        try {
            val requestQueue = Volley.newRequestQueue(this)
            val url = "https://github.com/login/oauth/access_token"
            val postRequest = object : StringRequest(Request.Method.POST, url,
                Response.Listener { response ->
                    try {
                        val token = response.substring(response.indexOf("=") + 1, response.indexOf("&"))
                    } catch (e: Exception) {
                        println(e)
                    }
                }, Response.ErrorListener { error -> Log.e("VOLLEY", error.toString()) }) {
                public override fun getParams(): Map<String, String> {
                    val params = HashMap<String, String>()
                    params["client_id"] = clientId
                    params["client_secret"] = clientSecret
                    params["code"] = code!!
                    return params
                }
            }

            requestQueue.add(postRequest)
        } catch (e: JSONException) {
            e.printStackTrace()
        }
    }

    fun onClickImgur(v: View) {
        globalclass.services = "imgur"
        val intent = Intent(Intent.ACTION_VIEW, Uri.parse("https://api.imgur.com/oauth2/authorize?client_id=" + "d1e08678c80ec65" + "&response_type=token"))
        startActivity(intent)
    }

    private fun onResumeImgur(uri: Uri) {
        println(uri)
        var token = Uri.parse("?" + uri.encodedFragment).getQueryParameter("access_token")
        if (token != null) {
            println("--------------------------------------{}{}>$token")
        } else if (uri.getQueryParameter("error") != null) {
            println("ERROR")
        }
    }
}