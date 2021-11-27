using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace CommonChat_Frontend
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();

            thread = new Thread(getMessages);
        }

        private string user_name;
        private void button1_Click(object sender, EventArgs e)
        {
            sendMessage();

        }
        async void sendMessage()
        {
            button1.Text = "Отправка...";
            button1.Enabled = false;
            textBox_message.Focus();
            await Task.Run(() =>
            {

                textBox_chat.AppendText($"[{user_name}]: {textBox_message.Text}\r\n");

                api.apiResponse.get($"{Net.HOST}?type=sendMsg&message={textBox_message.Text}&user_name={user_name}");
                textBox_message.Text = null;
                button1.Text = "Отправить";
                button1.Enabled = true;
            });
        }
        private void button2_Click(object sender, EventArgs e)
        {
            if(textBox_name.Text != null && textBox_name.Text != "")
            {
                user_name = textBox_name.Text;
                button2.Enabled = false;
                textBox_name.Enabled = false;
                thread.Start();


            }
            else
            {
                MessageBox.Show("Вы должны заполнить поле \"Ваше имя\"!");
            }
        }
        string last_message = null;
        Thread thread = null;

        delegate void setChatText(string text);
        void setChaText(string lastmessage)
        {
            try
            {
                if (lastmessage != last_message)
                {
                    last_message = lastmessage;
                    string res = null;
                    foreach (JObject message in JObject.Parse(last_message)["messages"])
                    {
                        res += ($"[{message.SelectToken("user_name").ToString()}]: {message.SelectToken("message").ToString()}\r\n");
                    }
                    textBox_chat.Clear();
                    textBox_chat.AppendText(res);
                    textBox_message.Focus();
                }
            }
            catch
            {

            }
        }

        void getMessages()
        {
            while (true)
            {
                string url = $"{Net.HOST}?type=getMessages";
                var webClient = new WebClient();
                var pars = new NameValueCollection();
                pars.Add("last_messages", last_message);
                var response = webClient.UploadValues(url, pars);
                string result = Encoding.UTF8.GetString(response);


                BeginInvoke(new setChatText(setChaText), result);
            }

        }

        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {
            if(thread != null)
            {
                thread.Abort();
            }
        }

        private void textBox_message_KeyPress(object sender, KeyPressEventArgs e)
        {
            if(e.KeyChar == (char)13)
            {
                sendMessage();
            }
        }
    }
}
