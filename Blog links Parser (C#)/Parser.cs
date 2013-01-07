using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;

namespace SeoParser
{
    static class Parser
    {
        public static void Parse(Item it)
        {
            Console.Write(String.Format("Parsing {0} to {1}: ", it.Url, it.Filename));
            List<string> result = it.Strategy.Parse(it.Url);

            Console.WriteLine(result.Count.ToString());

            if (!Directory.Exists("data"))
            {
                Directory.CreateDirectory("data");
            }

            TextWriter tw = new StreamWriter("data/" + it.Filename);

            foreach (string s in result)
                tw.WriteLine(s);

            tw.Close();
        }
    }
}
