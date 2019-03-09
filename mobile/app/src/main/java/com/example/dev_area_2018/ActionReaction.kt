package com.example.dev_area_2018

import android.content.Intent
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.support.design.widget.TextInputEditText
import android.util.Base64
import android.util.Log
import android.view.View
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.Spinner
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import org.json.JSONArray
import org.json.JSONObject

class ActionReaction : AppCompatActivity() {

    lateinit var globalClass: GlobalClass
    lateinit var aboutJson : JSONArray
    var args : ArrayList<Pair<String, ArrayList<String>>> = ArrayList()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_action_reaction)
        globalClass = applicationContext as GlobalClass

        findViewById<Spinner>(R.id.action).onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
            override fun onNothingSelected(parent: AdapterView<*>?) {
            }

            override fun onItemSelected(parent: AdapterView<*>?, view: View?, position: Int, id: Long) {
                val arrayNameAction2 : ArrayList<String> = ArrayList()
                for (i in 0..(aboutJson.length() - 1)) {
                    if (parent != null) {
                        if (aboutJson.getJSONObject(i).getString("name") == parent.getItemAtPosition(position).toString()) {
                            val test = JSONObject(aboutJson.getJSONObject(i).getString("actions"))
                            val keys = test.keys()
                            while (keys.hasNext()) {
                                val key = keys.next()
                                arrayNameAction2.add(key)
                                println(key)
                            }
                        }
                        val spinnerAction2 = findViewById<Spinner>(R.id.action2)
                        val spinnerArrayAction2 = ArrayAdapter<String>(
                            parent.context,
                            android.R.layout.simple_spinner_dropdown_item,
                            arrayNameAction2
                        )
                        spinnerArrayAction2.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
                        spinnerAction2.adapter = spinnerArrayAction2
                    }
                }
            }
        }

        findViewById<Spinner>(R.id.action2).onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
            override fun onNothingSelected(parent: AdapterView<*>?) {
            }

            override fun onItemSelected(parent: AdapterView<*>?, view: View?, position: Int, id: Long) {
                findViewById<TextInputEditText>(R.id.argvaction1).hint = ""
                findViewById<TextInputEditText>(R.id.argvaction2).hint = ""
                findViewById<TextInputEditText>(R.id.argvaction3).hint = ""
                for (i in 0..(aboutJson.length() - 1)) {
                    if (parent != null) {
                        if (aboutJson.getJSONObject(i).getString("name") == findViewById<Spinner>(R.id.action).selectedItem.toString()) {
                            val test = JSONObject(aboutJson.getJSONObject(i).getString("actions"))
                            val keys = test.keys()
                            while (keys.hasNext()) {
                                val key = keys.next()
                                if (key == parent.getItemAtPosition(position).toString()) {
                                    val test2 = JSONObject(test.get(key).toString()).getString("arguments")
                                    val tab = test2.split(',')
                                    var i3 = 1
                                    for (string in tab) {
                                        if (string != "[]") {
                                            if (i3 == 1)
                                                findViewById<TextInputEditText>(R.id.argvaction1).hint = string.split(':')[1].replace("}", "").replace("\"", "")
                                            if (i3 == 2)
                                                findViewById<TextInputEditText>(R.id.argvaction2).hint = string.split(':')[1].replace("}", "").replace("\"", "")
                                            if (i3 == 3)
                                                findViewById<TextInputEditText>(R.id.argvaction3).hint = string.split(':')[1].replace("}", "").replace("\"", "")
                                            i3++
                                        }
                                    }
                                    println(key)
                                }
                            }
                        }
                    }
                }
            }
        }

        findViewById<Spinner>(R.id.reaction).onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
            override fun onNothingSelected(parent: AdapterView<*>?) {
            }

            override fun onItemSelected(parent: AdapterView<*>?, view: View?, position: Int, id: Long) {
                val arrayNameReaction2 : ArrayList<String> = ArrayList()
                for (i in 0..(aboutJson.length() - 1)) {
                    if (parent != null) {
                        if (aboutJson.getJSONObject(i).getString("name") == parent.getItemAtPosition(position).toString()) {
                            val test = JSONObject(aboutJson.getJSONObject(i).getString("reactions"))
                            val keys = test.keys()
                            while (keys.hasNext()) {
                                val key = keys.next()
                                arrayNameReaction2.add(key)
                            }
                        }
                        val spinnerAction2 = findViewById<Spinner>(R.id.reaction2)
                        val spinnerArrayAction2 = ArrayAdapter<String>(
                            parent.context,
                            android.R.layout.simple_spinner_dropdown_item,
                            arrayNameReaction2
                        )
                        spinnerArrayAction2.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
                        spinnerAction2.adapter = spinnerArrayAction2
                    }
                }
            }
        }

        findViewById<Spinner>(R.id.reaction2).onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
            override fun onNothingSelected(parent: AdapterView<*>?) {
            }

            override fun onItemSelected(parent: AdapterView<*>?, view: View?, position: Int, id: Long) {
                findViewById<TextInputEditText>(R.id.argvreaction1).hint = ""
                findViewById<TextInputEditText>(R.id.argvreaction2).hint = ""
                findViewById<TextInputEditText>(R.id.argvreaction3).hint = ""
                for (i in 0..(aboutJson.length() - 1)) {
                    if (parent != null) {
                        if (aboutJson.getJSONObject(i).getString("name") == findViewById<Spinner>(R.id.reaction).selectedItem.toString()) {
                            val test = JSONObject(aboutJson.getJSONObject(i).getString("reactions"))
                            val keys = test.keys()
                            while (keys.hasNext()) {
                                val key = keys.next()
                                if (key == parent.getItemAtPosition(position).toString()) {
                                    val test2 = JSONObject(test.get(key).toString()).getString("arguments")
                                    val tab = test2.split(',')
                                    var i3 = 1
                                    for (string in tab) {
                                        if (string != "[]") {
                                            if (i3 == 1)
                                                findViewById<TextInputEditText>(R.id.argvreaction1).hint = string.split(':')[1].replace("}", "").replace("\"", "")
                                            if (i3 == 2)
                                                findViewById<TextInputEditText>(R.id.argvreaction2).hint = string.split(':')[1].replace("}", "").replace("\"", "")
                                            if (i3 == 3)
                                                findViewById<TextInputEditText>(R.id.argvreaction3).hint = string.split(':')[1].replace("}", "").replace("\"", "")
                                            i3++
                                        }
                                    }
                                    println(key)
                                }
                            }
                        }
                    }
                }
            }
        }

        val queue = Volley.newRequestQueue(this)
        val url = globalClass.apilink + "/about.json"
        val stringReq = StringRequest(
            Request.Method.GET, url,
            Response.Listener<String> { response ->
                val strResp = response.toString()
                val obj = JSONObject(strResp)
                aboutJson = JSONArray(JSONObject(obj.getString("server")).getString("services"))
                val arrayNameAction: ArrayList<String> = ArrayList()
                val arrayNameReaction: ArrayList<String> = ArrayList()
                for (i in 0..(aboutJson.length() - 1)) {
                    if (aboutJson.getJSONObject(i).getString("actions") != "[]")
                        arrayNameAction.add(aboutJson.getJSONObject(i).getString("name"))
                    if (aboutJson.getJSONObject(i).getString("reactions") != "[]")
                        arrayNameReaction.add(aboutJson.getJSONObject(i).getString("name"))
                    println(aboutJson.getJSONObject(i).getString("actions"))
                }
                val spinnerAction = findViewById<Spinner>(R.id.action)
                val spinnerArrayAction = ArrayAdapter<String>(this, android.R.layout.simple_spinner_dropdown_item, arrayNameAction)
                spinnerArrayAction.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
                spinnerAction.adapter = spinnerArrayAction
                val spinnerReaction = findViewById<Spinner>(R.id.reaction)
                val spinnerArrayReaction = ArrayAdapter<String>(this, android.R.layout.simple_spinner_dropdown_item, arrayNameReaction)
                spinnerArrayReaction.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
                spinnerReaction.adapter = spinnerArrayReaction
            },
            Response.ErrorListener { println("[ERROR]: FAILED") })
        queue.add(stringReq)
    }

    fun onClickBack(v: View) {
        val intent = Intent(this, SignServices::class.java)
        startActivity(intent)
    }

    fun onClickSendArea(v: View) {
        val queue = Volley.newRequestQueue(this)
        var url = globalClass.apilink + "/trigger"
        val postRequest = object : StringRequest(Request.Method.POST, url,
            Response.Listener { response ->
                var strResp = response.toString()
                println(strResp)
            },
            Response.ErrorListener { response ->
                Log.d("Error.Response", response.toString())
            }
        ) {
            override fun getParams(): Map<String, String> {
                val act1 = findViewById<TextInputEditText>(R.id.argvaction1).text.toString()
                val act2 = findViewById<TextInputEditText>(R.id.argvaction2).text.toString()
                val act3 = findViewById<TextInputEditText>(R.id.argvaction3).text.toString()
                val react1 = findViewById<TextInputEditText>(R.id.argvreaction1).text.toString()
                val react2 = findViewById<TextInputEditText>(R.id.argvreaction2).text.toString()
                val react3 = findViewById<TextInputEditText>(R.id.argvreaction3).text.toString()
                var action = ""
                var reaction = ""
                if (findViewById<TextInputEditText>(R.id.argvaction1).hint.isNotEmpty())
                    action += Base64.encodeToString(act1.toByteArray(Charsets.UTF_8), Base64.DEFAULT)
                if (findViewById<TextInputEditText>(R.id.argvaction2).hint.isNotEmpty())
                    action += ";" + Base64.encodeToString(act2.toByteArray(Charsets.UTF_8), Base64.DEFAULT)
                if (findViewById<TextInputEditText>(R.id.argvaction3).hint.isNotEmpty())
                    action += ";" + Base64.encodeToString(act3.toByteArray(Charsets.UTF_8), Base64.DEFAULT)
                if (findViewById<TextInputEditText>(R.id.argvreaction1).hint.isNotEmpty())
                    reaction += Base64.encodeToString(react1.toByteArray(Charsets.UTF_8), Base64.DEFAULT)
                if (findViewById<TextInputEditText>(R.id.argvreaction2).hint.isNotEmpty())
                    reaction += ";" + Base64.encodeToString(react2.toByteArray(Charsets.UTF_8), Base64.DEFAULT)
                if (findViewById<TextInputEditText>(R.id.argvreaction3).hint.isNotEmpty())
                    reaction += ";" + Base64.encodeToString(react3.toByteArray(Charsets.UTF_8), Base64.DEFAULT)
                val params = HashMap<String, String>()
                params["action_service"] = findViewById<Spinner>(R.id.action).selectedItem.toString()
                params["reaction_service"] = findViewById<Spinner>(R.id.reaction).selectedItem.toString()
                params["action"] = findViewById<Spinner>(R.id.action2).selectedItem.toString()
                params["reaction"] = findViewById<Spinner>(R.id.reaction2).selectedItem.toString()
                params["action_params"] = action
                params["reaction_params"] = reaction

                return params
            }

            override fun getHeaders(): MutableMap<String, String> {
                val headers = HashMap<String, String>()
                headers["Authorization"] = globalClass.token
                return headers
            }
        }
        queue.add(postRequest)
    }
}
