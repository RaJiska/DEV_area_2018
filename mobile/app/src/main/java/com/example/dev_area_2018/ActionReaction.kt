package com.example.dev_area_2018

import android.content.Intent
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import org.json.JSONObject

class ActionReaction : AppCompatActivity() {

    lateinit var globalClass: GlobalClass

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_action_reaction)
        globalClass = applicationContext as GlobalClass
        val queue = Volley.newRequestQueue(this)
        val url = globalClass.apilink + "/about.json"
        val stringReq = StringRequest(
            Request.Method.GET, url,
            Response.Listener<String> { response ->
                var strResp = response.toString()
                println(strResp)
            },
            Response.ErrorListener { println("[ERROR]: FAILED") })
        queue.add(stringReq)
    }

    fun onClickSendArea(v: View) {

    }

    fun onClickBack(v: View) {
        val intent = Intent(this, SignServices::class.java)
        startActivity(intent)
    }
}
